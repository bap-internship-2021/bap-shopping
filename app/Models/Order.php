<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PENDING_STATUS = 1;
    const FINISH_STATUS = 2;
    protected $fillable = ['user_id', 'status', 'voucher_id'];

//    public function
}
