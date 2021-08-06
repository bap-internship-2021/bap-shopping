<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class HomeController extends Controller
{
    //
    public function index(){
        // $orders = Order::where('status', Order::PENDING_STATUS)->get();
        // session('count-order', $orders);

        return view('admin.layouts.layouts');
    }
}
