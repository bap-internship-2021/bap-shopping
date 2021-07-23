<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherDetail extends Model
{
    use HasFactory;

    protected $table = 'voucher_details';
    protected $fillable = ['voucher_id', 'order_id', 'used_at'];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
