<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $table = 'specifications';
    protected $fillable = ['screen', 'camera', 'camera_selfie', 'ram', 'internal_memory', 'cpu', 'gpu', 'pin', 'sim', 'operating_system', 'made_in', 'release_time', 'description', 'product_id'];

    public function product(){
        return $this->hasOne(Product::class);
    }
}
