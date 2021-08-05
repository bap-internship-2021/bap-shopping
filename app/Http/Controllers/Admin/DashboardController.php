<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Statistical;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{   
    public function index(){
        return view('admin.dashboard.index');
    }

    public function statisticalProduct(){
        $products = OrderDetail::select('products.name', OrderDetail::raw('SUM(order_details.quantity) as soluong'))
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.status', 3)
            ->groupBy('products.name')
            ->orderBy('soluong', 'DESC')
            ->limit(3)
            ->get();
        $categories = Category::all();
        return view('admin.dashboard.tableProducts', compact(['categories', 'products']));
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

    public function selectByOption(Request $request){
        $data = $request->all();

        $startThisMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(); // đầu tháng này
        $startLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString(); //đầu tháng trước
        $endLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString(); //cuối tháng trước
        $lastSevenDays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString(); // 7 ngày trước
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString(); // 365 ngày qua
        $getNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7days'){
            $get = Statistical::whereBetween('order_date', [$lastSevenDays, $getNow])->orderBy('order_date', 'ASC')->get();
        } elseif($data['dashboard_value'] == 'lastmonth'){
            $get = Statistical::whereBetween('order_date', [$startLastMonth, $endLastMonth])->orderBy('order_date', 'ASC')->get();
        } elseif($data['dashboard_value'] == 'thismonth'){
            $get = Statistical::whereBetween('order_date', [$startThisMonth, $getNow])->orderBy('order_date', 'ASC')->get();
        } else{
            $get = Statistical::whereBetween('order_date', [$year, $getNow])->orderBy('order_date', 'ASC')->get();
        }

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
    }

    public function chartDefault(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $getNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date', [$sub30days, $getNow])->orderBy('order_date', 'ASC')->get();

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
    }

    public function usersVip(){
        $users = Order::select('orders.name' ,Order::raw('count(user_id) as soluong'))
        ->where('status', 3)
        ->groupBy('name')
        ->orderBy('soluong', 'DESC')
        ->get();
        // dd($users);
        return view('admin.dashboard.statisticalUsers', compact('users'));
    }

    
}
