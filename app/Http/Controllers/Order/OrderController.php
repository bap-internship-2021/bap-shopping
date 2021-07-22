<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Sale\SaleController;

class OrderController extends Controller
{
    public function confirmation(Request $request, SaleController $saleController)
    {
        if (session()->has('cart')) {
            if (!empty($request->input('saleCode'))) { // If user request has sale code
                if (count($saleController->show($request->input('saleCode'))) > 0) {
                    $sale = $saleController->show($request->input('saleCode'));
                    $discount = $sale->first()->discount;  // Discount percent (%)
                    $subTotal = session()->get('subTotal'); // tổng phụ
                    $salePrice = ($subTotal * $discount) / 100;
                    $grandTotal = $subTotal - $salePrice; // Tổng chính
                    session()->put('salePrice', $salePrice);
                    session()->put('grandTotal', $grandTotal);
                    dd('Order thanh cong');
                    return view('order.confirmation');
                } else { // if sale code not found
                    return back()->with(['errorSaleCode' => 'Mã giảm giá không tồn tại'])->withInput();
                }
            }
            $subTotal = session()->get('subTotal');
            session()->put('salePrice', 0);
            session()->put('grandTotal', $subTotal);
            dd('Order thanh cong');
            return view('order.confirmation');
        } else {
            return route('carts.index');
        }
    }
    // TODO: Xem lại bảng order
    public function store()
    {

    }
}
