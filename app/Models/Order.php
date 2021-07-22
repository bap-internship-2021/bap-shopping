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
    protected $fillable = ['user_id', 'status'];

    public function voucherDetails()
    {
        return $this->hasMany(VoucherDetail::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
