<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function handleIndex(){
        $orders = Order::select('orders.*', 'products.name as productname', 'order_details.quantity')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('orders.status', '1')
            ->paginate(5);
        // dd($orders);
        return view('admin.order.index', compact('orders'));
    }
}
