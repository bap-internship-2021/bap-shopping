<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listAllProducts()
    {
        $products = Product::paginate(10);
        return view('product/list-products', compact(['products']));
    }

    public function detailProductInfo(Product $product)
    {
        $product = Product::findOrFail($product->id);
        return view('product.detail-product', compact(['product']));
    }
}
