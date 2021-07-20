<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const IPHONE = 1;
    const IMAC = 2;
    const IPAD = 3;
    const MACBOOK = 4;
    const APPLE_WATCH = 5;
    const AIR_POD = 6;

    protected $table = 'categories';
    protected $fillable = [
        'name'
    ];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

}
