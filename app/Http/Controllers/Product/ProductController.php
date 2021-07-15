<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listAllProducts()
    {
        $products = Product::paginate(10);

    }

    public function detailProductInfo(Product $product, Request $request)
    {
        $product = Product::findOrFail($product->id);
        return view('product.detail-product', compact(['product']));
    }

    public function getProductQuantityAPI($id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
}
