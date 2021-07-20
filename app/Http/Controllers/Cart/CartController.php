<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            $subTotal = 0;
            $data = [];
            foreach ($cart as $key => $item) {
                $data[$key]['name'] = $item['name'];
                $data[$key]['image'] = $item['image'];
                $data[$key]['quantity'] = $item['quantity'];
                $data[$key]['price'] = $item['price'];
                $data[$key]['totalPrice'] = $item['quantity'] * $item['price'];
                $subTotal += $data[$key]['totalPrice']; // Total price of all product
            }

            return view('cart.index', compact(['subTotal', 'data']));
        }

        return view('cart.index');
    }

//    TODO: create store request item to cart
    public function store(Request $request): JsonResponse
    {
        $cart = $request->session()->get('cart');
        $productId = $request->input('id');

        // update item in cart if this item exist
//        if (isset($cart[$productId])) {
//            unset($cart[$productId]);
//        }

        // else add new item
        $cart[$productId] = [
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'image' => $request->input('image')
        ];
        $request->session()->put('cart', $cart);

        return response()->json(['Success' => 'success'], 200);
    }


    public function destroy(): RedirectResponse
    {
        session()->forget('cart');
        return redirect()->back();
    }

    public function destroyItemInCart(Request $request)
    {
        $cart = $request->session()->get('cart');
        $productId = $request->input('productId');
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return back();
    }

//    public function checkout()
//    {
//        if (session()->has('cart')) {
//            $cart = session()->get('cart');
//            $subTotal = 0;
//            $data = [];
//            foreach ($cart as $key => $item) {
//                $data[$key]['name'] = $item['name'];
//                $data[$key]['quantity'] = $item['quantity'];
//                $data[$key]['totalPrice'] = $item['quantity'] * $item['price'];
//                $subTotal += $data[$key]['totalPrice']; // Total price of all product
//            }
//            return view('cart.cart-checkout', compact(['data', 'subTotal']));
//        }
//
//        return view('cart.cart-checkout');
//    }
}
