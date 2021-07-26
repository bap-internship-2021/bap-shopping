<?php

namespace App\Http\Controllers\Voucher;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function listVoucher()
    {
        $currentDate = Carbon::now('Asia/Ho_Chi_Minh');
        $currentDate->toDateTimeString();

        $vouchers = Voucher::whereDate('from', '<=', $currentDate)
            ->whereDate('to', '>=', $currentDate)
            ->where('status', Voucher::DUE_STATUS)
            ->where('quantity', '>', 0)
            ->paginate(10);
        return view('voucher.index', compact('vouchers'));
    }

    public static function getVoucherQuantity($id)
    {
        $voucher = Voucher::where('id', $id)->get();
        return $voucher->first()->quantity;
    }

    public static function getDiscount($id)
    {
        return Voucher::find($id)->discount;
    }

    public static function checkVoucherCodeIsExist($voucherCode)
    {
        return Voucher::where('code', $voucherCode)->where('status', Voucher::DUE_STATUS)->get();
    }
}
