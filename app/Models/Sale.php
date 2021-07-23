<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'voucher';
    protected $fillable = [
        'name',
        'sale_code',
        'discount',
        'sales_amount',
        'min_price_to_apply',
        'from',
        'to'
    ];
}
