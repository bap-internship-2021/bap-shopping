<?php

namespace App\Http\Controllers\Voucher;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
        $currentDate->toDateTimeString();

        $vouchers = Voucher::where('from', '<=', $currentDate)
            ->where('to', '>=', $currentDate)
            ->where('status', Voucher::DUE_STATUS)
            ->paginate(10);
        return view('voucher.index', compact('vouchers'));
    }

    public static function checkVoucherCodeIsExist($voucherCode)
    {
        return Voucher::where('code', $voucherCode)->where('status', Voucher::DUE_STATUS)->get();
    }
}
