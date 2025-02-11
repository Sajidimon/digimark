<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //this method will display dashboard page;
    public function index()
    {
        $products = Product::all();
        $services = Service::all();
        $orders = Order::all();
        return Inertia::render(
            'Admin/Home',
            [
                'products' => $products,
                'services' => $services,
                'orders' => $orders,
            ]
        );
    }
}
