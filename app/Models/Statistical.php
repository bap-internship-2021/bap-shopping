<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;

    public $table = 'statisticals';
    protected $fillable = ['order_date', 'sales', 'profit', 'quantity', 'total_order'];
}
