<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Voucher\VoucherController;
use Illuminate\Http\Request;
use App\Http\Requests\User\Order\UserConfirmRequest;

class OrderController extends Controller
{
    public function confirmation(UserConfirmRequest $request)
    {
        if (session()->has('cart')) {
            if (!empty($request->input('code'))) { // If user request has voucher code
                if (count(VoucherController::checkVoucherCodeIsExist($request->input('code'))) > 0) {
                    $sale = VoucherController::checkVoucherCodeIsExist($request->input('code'));
                    $discount = $sale->first()->discount;  // Discount percent (%)
                    $subTotal = session()->get('subTotal'); // tổng phụ
                    $voucherPrice = ($subTotal * $discount) / 100;
                    $grandTotal = $subTotal - $voucherPrice; // Tổng chính
                    session()->put('voucherPrice', $voucherPrice);
                    session()->put('grandTotal', $grandTotal);
                    return view('order.confirmation');
                } else { // if voucher code not found
                    return back()->with(['errorVoucherCode' => 'Mã giảm giá không tồn tại'])->withInput();
                }
            }
            $subTotal = session()->get('subTotal');
            session()->put('voucherPrice', 0);
            session()->put('grandTotal', $subTotal);
            return view('order.confirmation');
        } else {
            return route('carts.index');
        }
    }

    // TODO: Xem lại bảng order
    public function store()
    {
        dd(session()->all());
    }
}
