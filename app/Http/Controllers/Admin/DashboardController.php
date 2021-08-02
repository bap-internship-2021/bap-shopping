<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    public function index(){
        return view('admin.dashboard.index');
    }

    public function statisticalProduct(){
        $quantity = Product::select('quantity')->get();
        $name = Product::select('name')->get();
        return view('admin.dashboard.statisticalProduct', compact(['quantity', 'name']));
    }
}
