<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    public function index(){
        return view('admin.dashboard.index');
    }

    public function statisticalProduct(){
        $categories = Category::all();
        return view('admin.dashboard.statisticalProduct', compact('categories'));
    }

    public function statisticalProductByCategory($id){
        // $quantity = Product::select('quantity')->get();
        // $name = Product::select('name')->get();
        // return view('admin.dashboard.test', compact(['quantity', 'name']));
        $categories = Category::all();

        $products = Product::select('products.*')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.category_id', $id)
            ->get();
        // dd($products);
        return view('admin.dashboard.statisticalProductByIphone', compact(['products', 'categories']));
    }
}
