<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return Inertia::render('User/Shop/Checkout', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'address'=>'required',
            'mobile'=>'required'
        ]);


        $cart = session()->get('cart', []);

        $totalPrice = 0;

        foreach($cart as $item){
            $totalPrice += $item['price'] * $item['quantity'];
            Order::create([
                'user_id'=> Auth::check() ? Auth::id() : null,
                'product_name' => $item['name'],
                'grand_total' => $totalPrice,
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'payment_method' => $request->payment_method
            ]);
        }

        session()->forget('cart');

        return redirect()->route('home');
    }
    
}
