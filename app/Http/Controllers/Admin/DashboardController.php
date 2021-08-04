<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Statistical;
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
        $categories = Category::all();
        $products = Product::select('products.*')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.category_id', $id)
            ->get();
        return view('admin.dashboard.statisticalProductByIphone', compact(['products', 'categories']));
    }

    public function statisticalSale(){
        return view('admin.dashboard.statisticalSale');
    }

    public function searchSaleByDate(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistical::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();

        foreach($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'price' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
        // return response()->json(['data' => $data], 200);
    }
}
