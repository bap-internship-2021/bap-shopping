<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;


    const PENDING_STATUS = 1;
    const SENDING_STATUS = 2;
    const FINISH_STATUS = 3;
    protected $fillable = ['custom_order_id', 'user_id', 'date_start', 'date_end',
                           'status', 'total_price', 'phone', 'name', 'address'];

    public function voucherDetails()
    {
        return $this->hasMany(VoucherDetail::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
