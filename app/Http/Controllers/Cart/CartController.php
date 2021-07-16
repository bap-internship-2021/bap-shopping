<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProductToCart(Request $request): JsonResponse
    {
        $cart = $request->session()->get('cart');
        $productId = $request->input('id');

        // update item in cart if this item exist
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $cart = array_values($cart); // reset key index and return value
        }

        // else add new item
        $cart[$productId] = [
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price')
        ];
        $request->session()->put('cart', $cart);

        return response()->json(['Success' => 'success'], 200);
    }

    public function listItemInCart()
    {
        if (session()->has('cart')) {
            return view('cart.list-item')->with(['cart' => session()->get('cart')]);
        }

        return view('cart.list-item');
    }

    public function deleteAllItemCart(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return redirect()->back();
    }

    public function cartCheckout()
    {
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            $subTotal = 0;
            $data = [];
            foreach ($cart as $key => $item) {
                $data[$key]['name'] = $item['name'];
                $data[$key]['quantity'] = $item['quantity'];
                $data[$key]['totalPrice'] = $item['quantity'] * $item['price'];
                $subTotal += $data[$key]['totalPrice'];
            }
            return view('cart.cart-checkout', compact(['data', 'subTotal']));
        }

        return view('cart.cart-checkout');
    }
}
