<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $DUE_STATUS)
 */
class Voucher extends Model
{
    use HasFactory;

    const DUE_STATUS = 1; // Con han
    const EXPIRED_STATUS = 2; // Het han

    public $table = 'vouchers';
    protected $fillable = ['name', 'code', 'from', 'to', 'status', 'discount', 'min_price', 'quantity'];

    public function voucherDetails()
    {
        return $this->hasMany(VoucherDetail::class );
    }
}
