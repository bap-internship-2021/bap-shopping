<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request){
        $data = $request->all();

        if($data['keywords']){
            $products = Product::where('name', 'LIKE', '%'.$data['keywords'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;">';
            foreach($products as $value){
                $output .= '<li class="li_search_ajax"><a href="#">'.$value->name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function index(Request $request){
        $data = $request->all();
        
        if($data && isset($data['keywords'])){
            $products = Product::with('images')->where('name', 'LIKE', '%'.$data['keywords'].'%')->paginate(5);

            return view('admin.search.searchProduct')->with('products', $products);
        }
        return back()->with('status', 'NOT FOUND');
    }

    public function searchOrder(Request $request){
        $data = $request->all();

        if($data['orderkey']){
            $orders = Order::where('custom_order_id', 'LIKE', '%'.$data['orderkey'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block; margin-left:330px;">';
            foreach($orders as $value){
                $output .= '<li class="li_search_order"><a href="#">'.$value->custom_order_id.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function searchOrderResult(Request $request){
        $data = $request->all();
        
        if($data && isset($data['orderkey'])){
            $orders = Order::where('orders.custom_order_id', 'LIKE', '%'.$data['orderkey'].'%')->paginate(5);

            return view('admin.search.searchOrder')->with('orders', $orders);
        }
        return back()->with('status', 'NOT FOUND');
    }
}
