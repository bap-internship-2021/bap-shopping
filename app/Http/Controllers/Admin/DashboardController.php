<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Statistical;
use App\Models\Visitor;
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

        $startThisMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(); // ?????u th??ng n??y
        $startLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString(); //?????u th??ng tr?????c
        $endLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString(); //cu???i th??ng tr?????c
        $lastSevenDays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString(); // 7 ng??y tr?????c
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString(); // 365 ng??y qua
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
        ->having('soluong', '>=', 5)
        ->orderBy('soluong', 'DESC')
        ->paginate(5);
        // dd($users);
        return view('admin.dashboard.statisticalUsers', compact('users'));
    }

    public function statisticalAccess(Request $request){
        $user_ip_address = $request->ip();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString(); //?????u th??ng tr?????c
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString(); //cu???i th??ng tr?????c
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(); // ?????u th??ng n??y
        $oneyear = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString(); // 365 ng??y qua
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $visitor_of_last_month = Visitor::whereBetween('date', [$early_last_month, $end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_last_month->count();

        $visitor_of_this_month = Visitor::whereBetween('date', [$early_this_month, $now])->get();
        $visitor_this_month_count = $visitor_of_this_month->count();

        $visitor_of_year = Visitor::whereBetween('date', [$oneyear, $now])->get();
        $visitor_of_year_count = $visitor_of_year->count();

        $visitor_current = Visitor::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitor_current->count();

        if($visitor_count < 1){
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        $visitors = Visitor::all();
        $visitors_total = $visitors->count();

        return view('admin.dashboard.statisticalAccess', compact(['visitors_total', 'visitor_count', 'visitor_last_month_count', 'visitor_this_month_count', 'visitor_of_year_count']));
    }
    
}
