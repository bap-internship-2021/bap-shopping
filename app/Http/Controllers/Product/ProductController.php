<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Category $category)
    {
        $products = Product::with(['images'])->where('category_id', $category->id)
            ->paginate(10);

        return view('product.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product = Product::where('id', $product->id)->with('images')->get();
        return view('product.show', compact('product'));
    }

     public function getProductQuantityAPI($id): \Illuminate\Http\JsonResponse
     {
         $product = Product::findOrFail($id);
         return response()->json($product);
     }
}
