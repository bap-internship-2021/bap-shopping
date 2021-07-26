<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {
//        dd(session()->get('cart'));
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

    public function store(Request $request)
    {
        $cart = $request->session()->get('cart');
        $productId = $request->input('id');
        $cart[$productId] = [
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'image' => $request->input('image')
        ];
        $request->session()->put('cart', $cart);

        return response()->json(['Success' => 'success'], 200);
    }

    public static function destroy(): RedirectResponse
    {
        session()->forget(['cart', 'subTotal', 'grandTotal', 'voucherPrice', 'voucherId']);
        return redirect()->back();
    }

    public function destroyItemInCart(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart');
        $productId = $request->input('productId');
        unset($cart[$productId]);
        session()->put('cart', $cart); // Update cart session
        return back();
    }
}
