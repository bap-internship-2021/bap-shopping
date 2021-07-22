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
            session()->put('subTotal', $subTotal);
            return view('cart.index', compact(['subTotal', 'data']));
        }

        return view('cart.index');
    }

//    TODO: create store request item to cart
    public function store(Request $request): JsonResponse
    {
        $cart = $request->session()->get('cart');
        $productId = $request->input('id');

// TODO: Ask sếp should i need update item in cart by unset cart['id'] because is not necessary (some line below)
        // update item in cart if this item exist
//        if (isset($cart[$productId])) {
//            unset($cart[$productId]);
//        }

        // else add new item => TODO: because it is array contain array['id'] so not we not need to unset
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
        session()->forget(['cart', 'subTotal']); // forget session with key = 'cart'
        return redirect()->back();
    }

    public function destroyItemInCart(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart');
        $productId = $request->input('productId');
        unset($cart[$productId]); // unset cart['id'] = product id
        session()->put('cart', $cart); // update cart session
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
