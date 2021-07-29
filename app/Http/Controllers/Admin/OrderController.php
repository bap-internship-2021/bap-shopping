<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function listOrderPending(){
        $orders = Order::where('status', '1')->paginate(5);
        return view('admin.order.listOrderPending', compact('orders'));
    }

    public function listOrderSending(){
        $orders = Order::where('status', '2')->paginate(5);
        return view('admin.order.listOrderSending', compact('orders'));
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
            // $userEmail = $userEmail;

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
}
