<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    const DUE_STATUS = 1;
    const EXPIRED_STATUS = 2;

    protected $table = 'vouchers';
    protected $fillable = ['code', 'from', 'to', 'status', 'discount', 'min_price', 'quantity'];

    public function voucherDetails()
    {
        return $this->hasMany(VoucherDetail::class );
    }
}
