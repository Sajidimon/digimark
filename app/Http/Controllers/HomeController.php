<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $services = Service::all();
        return Inertia::render('User/Home/Index', [
            'products' => $products,
            'services' => $services,
        ]);
    }
}
