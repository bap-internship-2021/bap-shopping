<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProductToCart(Request $request): JsonResponse
    {
        $data = $request->only(['id', 'name', 'price', 'quantity']);

        $request->session()->push('cart.products', [
            'productId' => $data['id'],
            'productName' => $data['name'],
            'quantity' => $data['quantity'],
            'price' => $data['price'] * $data['quantity']
        ]);

        return response()->json(['Success' => 'success']);
    }

    public function listItemInCart(Request $request)
    {
        if ($request->session()->has('cart.products')) { // If exist key products in cart
            $cart = $request->session()->get('cart.products');
            return view('cart.list-item', compact('cart'));
        } else {
            return view('cart.list-item');
        }
    }

    public function deleteAllItemCart(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->session()->forget('cart.products');
        return redirect()->back();
    }
}