<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    //this method will display all orders;
    public function index()
    {
        $orders = Order::all();
        return Inertia::render('Admin/Orders/Orders', compact('orders'));
    }

    //this method will delete order;
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }
}
