<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    public function index(){
        $price = Product::select('price')->get();
        $name = Product::select('name')->get();
        return view('admin.dashboard.index', compact(['price', 'name']));
    }
}
