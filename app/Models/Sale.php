<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @method static where(string $string, mixed $input)
 * @method static find($id)
 */
class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
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
