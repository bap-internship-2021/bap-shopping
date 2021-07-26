<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static findOrFail(mixed $id)
 * @method static paginate(int $int)
 * @method static find(mixed $input)
 * @property mixed id
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'price', 'quantity', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function specification(){
        return $this->hasOne(Specification::class);
    }
}
