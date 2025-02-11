<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    //this method will display cart page;
    public function displayCart()
    {
        return Inertia::render('User/Shop/Cart', [
            'cart' => session()->get('cart', [])
        ]);
    }

    //this method will store cart;
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->id] = [
                'name' => $request->name,
                'image' => $request->image,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    //this method will delete cart;
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back();
    }
}
