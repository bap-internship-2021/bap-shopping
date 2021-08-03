<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Comment\CommentController;
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
        $productId = $product->id;
        $product = Product::where('id', $productId)->with(['images', 'specification'])->get();
        $comments = CommentController::listCommentsByProduct($productId);
        return view('product.show', compact('product', 'comments'));
    }

    public function getProductQuantityAPI($id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function searchProduct(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');

            $product = Product::where('name', 'like', "%$search%")->get();
            return response()->json(['product' => $product], 200);
        }
    }
}
