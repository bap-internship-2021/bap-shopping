<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        
        if($data['keywords']){
            $products = Product::with('images')->where('name', 'LIKE', '%'.$data['keywords'].'%')->paginate(5);
            return view('admin.search.index')->with('products', $products);
        }

    }
}
