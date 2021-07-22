<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::paginate(10);
        return view('sale.index', compact('sales'));
    }

    public function show($saleCode)
    {
        return Sale::where('sale_code', $saleCode)->get();
    }
}
