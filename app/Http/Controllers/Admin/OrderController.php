<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CancelOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function listAllOrder(){
        $orders = DB::table('orders')
             ->select(DB::raw('count(*) as soluong ,status as trangthai'))
             ->groupBy('status')
             ->get();
        $orders = json_decode(json_encode($orders), true);
        // dd($orders[0]['trangthai']);
        return view('admin.order.listOrder', compact('orders'));
    }

    public function listOrderByStatus($status){
        if($status == Order::PENDING_STATUS){
            $orders = Order::where('status', Order::PENDING_STATUS)->paginate(5);
        }elseif($status == Order::SENDING_STATUS){
            $orders = Order::where('status', Order::SENDING_STATUS)->paginate(5);
        }elseif($status == Order::FINISH_STATUS){
            $orders = Order::where('status', Order::FINISH_STATUS)->paginate(5);
        }elseif($status == Order::CANCEL_STATUS){
            $orders = Order::where('status', Order::CANCEL_STATUS)->paginate(5);
        }
        return view('admin.order.listOrderByStatus', compact('orders'));
    }

    public function detailOrder($id){
        $order = Order::select('orders.*', 'products.name as productname', 'order_details.quantity')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->where('orders.id', $id)
        ->get();
        return view('admin.order.detailOrder', compact('order'));
    }

    public function acceptOrder($id){

        $order = DB::table('orders')->where('id', $id)->update(['status' => 2]);
        
        if($order) {
            $userorder = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.id', $id)
            ->get();
         
            foreach($userorder as $item){
                $userEmail = $item->email;
            }

            $details = [
                'title' => 'Thông báo đơn hàng từ BAP',
                'body' => 'Đơn hàng của bạn đã được phê duyệt. Chúng tôi sẽ giao hàng cho bạn trong vòng 5-7 ngày.',
                'userEmail' => $userEmail
            ];

            Mail::send('emails.admin.admin_notifyOrder', $details, function($message) use ($userEmail) {
                $message->to($userEmail)
                ->subject('BAP SHOP thông báo đơn hàng');
                $message->from('quangdt1603@gmail.com','BAP SHOP');
            });

            return back()->with('status', 'Duyệt đơn hàng thành công');
        }

    }

    public function acceptAllOrder(){
        $orders = DB::table('orders')->where('status', 1)->update(['status' => 2]);

        if($orders){
            $userorder = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->get();

            foreach($userorder as $item){
                $userEmail = $item->email;
                $details = [
                    'title' => 'Thông báo đơn hàng từ BAP',
                    'body' => 'Đơn hàng của bạn đã được phê duyệt. Chúng tôi sẽ giao hàng cho bạn trong vòng 5-7 ngày.',
                    'userEmail' => $userEmail
                ];

                Mail::send('emails.admin.admin_notifyOrder', $details, function($message) use ($userEmail) {
                    $message->to($userEmail)
                    ->subject('BAP SHOP thông báo đơn hàng');
                    $message->from('quangdt1603@gmail.com','BAP SHOP');
                });
            };

            return back()->with('status', 'Duyệt tất cả đơn hàng thành công');
        }
    }

    public function cancelOrderPage($id){
        $order = Order::select('orders.*', 'products.name as productname', 'order_details.quantity', 'users.email as useremail')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->where('orders.id', $id)
        ->get();
        return view('admin.order.cancelOrder', compact('order'));
    }

    public function cancelOrder(CancelOrderRequest $request ,$id){
        $order = DB::table('orders')->where('id', $id)->update(['status' => 4]);
        $email = $request->input('email');
        $content = $request->input('content');

        if($order){
            $details = [
                'title' => 'Thông báo đơn hàng từ BAP',
                'body' => $content,
                'userEmail' => $email
            ];

            Mail::send('emails.admin.admin_notifyOrder', $details, function($message) use ($email) {
                $message->to($email)
                ->subject('BAP SHOP thông báo đơn hàng');
                $message->from('quangdt1603@gmail.com','BAP SHOP');
            });

            return back()->with('status', 'Hủy đơn hàng thành công');
        }
    }

    public function finishOrder($id){
        $order = DB::table('orders')->where('id', $id)->update(['status' => 3]);

        if($order){
            return back()->with('status', 'Đã hoàn thành đơn hàng');
        }
    }
}
