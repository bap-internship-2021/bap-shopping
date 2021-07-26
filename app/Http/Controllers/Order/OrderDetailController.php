<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Voucher\VoucherController;

class OrderDetailController extends OrderController
{
    public function getOrderDetail($orderId)
    {
        $order = parent::show($orderId);
        $orderDetails = OrderDetail::where('order_id', $orderId)->with('product')->simplePaginate(5);
        $data = [];
        foreach ($orderDetails as $key => $orderDetail) {
            $data[$key] = ($orderDetail->product->price * $orderDetail->quantity);
        }
        $subTotalPrice = 0;
        $subTotalPrice = array_sum($data);

        if ($order->voucherDetails->count() > 0) { // If order has voucher then get voucher discount
            $voucherId = $order->voucherDetails->first()->voucher_id;
            $discount = VoucherController::getDiscount($voucherId);
            return view('order.order-details', compact('order', 'orderDetails', 'subTotalPrice', 'discount'));
        }
        return view('order.order-details', compact('order', 'orderDetails', 'subTotalPrice'));
    }
}
