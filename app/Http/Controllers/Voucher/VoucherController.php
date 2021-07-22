<?php

namespace App\Http\Controllers\Voucher;

use App\Http\Controllers\Controller;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::paginate(10);
        return view('voucher.index', compact('vouchers'));
    }

    public function show($voucherCode)
    {
        return Voucher::where('voucher_code', $voucherCode)->where('status', Voucher::DUE_STATUS)->get();
    }
}
