<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function listOrderPending(){
        $orders = Order::where('status', '1')->paginate(5);
        return view('admin.order.listOrderPending', compact('orders'));
    }

    public function detailOrder($id){
        $order = Order::select('orders.*', 'products.name as productname', 'order_details.quantity')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->where('orders.id', $id)
        ->get();
        return view('admin.order.detailOrder', compact('order'));
    }
}
