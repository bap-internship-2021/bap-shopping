<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Voucher\VoucherController;
use App\Http\Requests\User\Order\UserConfirmRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Http\Controllers\Cart\CartController;

class OrderController extends Controller
{
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

    public function store()
    {
        $cart = session()->get('cart');
        $userId = Auth::id();
        $voucherPrice = session()->get('voucherPrice');
        $order = ['user_id' => $userId, 'date_start' => now(), 'date_end' => now(), 'status' => Order::PENDING_STATUS];

        $orderDetails = [];
        foreach ($cart as $key => $item) {
            $orderDetails[$key]['product_id'] = $key;
            $orderDetails[$key]['quantity'] = $item['quantity'];
        }
        if ($voucherPrice > 0) {
            $voucher = ['voucher_id' => session()->get('voucherId'), 'used_at' => now()];
            $order = Order::create($order);
            $order->orderDetails()->createMany($orderDetails); // Insert record 'order_details' table with order id
            $order->voucherDetails()->create($voucher);
        } else {
            $order = Order::create($order); // Insert record to 'orders' tables
            $order->orderDetails()->createMany($orderDetails); // Insert record 'order_details' table with order id
        }

        CartController::destroy(); // Call back delete cart
        return 'success';

    }
}
