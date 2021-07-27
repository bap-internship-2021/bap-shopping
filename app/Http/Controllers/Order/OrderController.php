<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Voucher\VoucherController;
use App\Http\Requests\User\Order\UserConfirmRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Voucher;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Mail\MailController;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with(['orderDetails.product'])->paginate(6);
        return view('Order.index', compact('orders'));
    }


    /**
     * Check order and caulator data to push order tables
     *
     * @param  mixed $request
     * @return void
     */
    public function confirmation(UserConfirmRequest $request)
    {
        $voucher = VoucherController::checkVoucherCodeIsExist($request->input('code'));
        if (session()->has('cart')) {
            if (!empty($request->input('code'))) { // If user request has voucher
                if (count($voucher) > 0) {
                    if ($voucher->first()->min_price <= session()->get('subTotal')) {
                        $sale = VoucherController::checkVoucherCodeIsExist($request->input('code'));
                        $discount = $sale->first()->discount;  // Discount percent (%)
                        $subTotal = session()->get('subTotal'); // tổng phụ
                        $voucherPrice = ($subTotal * $discount) / 100;
                        $grandTotal = $subTotal - $voucherPrice; // Tổng chính
                        session()->put('voucherPrice', $voucherPrice);
                        session()->put('voucherId', $voucher->first()->id);
                        session()->put('grandTotal', $grandTotal);
                        return view('order.confirmation');
                    } else {
                        return back()->with(['errorVoucherCode' => 'Đơn hàng không đủ điều kiện để sử dụng mã giảm giá'])->withInput();
                    }
                } else { // if voucher code not found
                    return back()->with(['errorVoucherCode' => 'Mã giảm giá không tồn tại'])->withInput();
                }
            } else { // If request not have voucher code then
                $subTotal = session()->get('subTotal');
                session()->put('voucherPrice', 0);
                session()->forget('voucherId');
                session()->put('grandTotal', $subTotal);
                return view('order.confirmation');
            }
        } else {
            return route('carts.index');
        }
    }

    public function show($id)
    {
        return Order::find($id);
    }

    public function store()
    {
        DB::beginTransaction();

        try {
            $cart = session()->get('cart');
            $userId = Auth::id();
            if (session()->has('userInfo')) {
                $userOrder = [
                    'user_id' => $userId,
                    'total_price' => session()->get('grandTotal'),
                    'address' => session()->get('userInfo')['address'],
                    'name' => session()->get('userInfo')['name'],
                    'phone' => session()->get('userInfo')['phone']
                ];
            } else {
                $userOrder = [
                    'user_id' => $userId,
                    'total_price' => session()->get('grandTotal'),
                    'address' => Auth()->user()->address,
                    'name' => Auth()->user()->name,
                    'phone' => Auth()->user()->phone
                ];
            }
            $voucherPrice = session()->get('voucherPrice');

            $orderDetails = [];
            foreach ($cart as $key => $item) {
                $product = Product::where('id', $key)->get();
                $productQuantity = $product->first()->quantity;
                $productQuantity -= $item['quantity'];
                Product::where('id', $key)->update(['quantity' => $productQuantity]);
                $orderDetails[$key]['product_id'] = $key;
                $orderDetails[$key]['quantity'] = $item['quantity'];
            }
            if ($voucherPrice > 0) {
                $voucher = ['voucher_id' => session()->get('voucherId'), 'used_at' => now()];
                $order = Order::create($userOrder);
                $order->orderDetails()->createMany($orderDetails); // Insert record 'order_details' table with order id
                $order->voucherDetails()->create($voucher);
                $voucherQuantity = VoucherController::getVoucherQuantity(session()->get('voucherId'));
                $voucherQuantity -= 1;
                Voucher::where('id', session()->get('voucherId'))->update(['quantity' => $voucherQuantity]);
            } else {

                $order = Order::create($userOrder); // Insert record to 'orders' tables
                $order->orderDetails()->createMany($orderDetails); // Insert record 'order_details' table with order id
            }
            DB::commit();
            // all good
            CartController::destroy(); //  delete cart
            MailController::notifyOrder(); // send mail notify to user
            return redirect()->route('carts.index')->with(['notify-order' => 'Thanh toán thành công, cảm ơn quý khách.']);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            dd($e->getMessage());
            return redirect()->route('carts.index')->with(['notify-order' => 'Có lỗi xảy ra, xin quý khách thử lại']);
        }
    }
}
