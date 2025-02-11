<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Admin/Products/Products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Admin/Products/AddProduct', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'regular' => 'required|integer',
            'discount' => 'nullable|integer',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'demo_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('images', time() . '_' . $request->file('image')->getClientOriginalName(), 'public');
        } else {
            $path = null;
        }

        Product::create([
            'name' => $request->name,
            'regular' => $request->regular,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'demo_link' => $request->demo_link,
            'image' => $path,
        ]);

        return redirect()->back()->with('success', 'product created successfull');

    }

    /**
     * Display the specified resource.
     */
    public function show($productName)
    {
        $cart = session()->get('cart', []);
        $product = Product::where('name', '=', $productName)->firstOrFail();
        return Inertia::render('User/Home/SingleProduct', compact('product', 'cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return Inertia::render('Admin/Products/EditProduct', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'regular' => 'nullable|integer',
            'discount' => 'nullable|integer',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'demo_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {

            if($product->image){
                Storage::disk('public')->delete($product->image);
            }

            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $validatedData['image'] = $path;
        }else{
            $validatedData['image'] = $product->image;
        }

        $product->update($validatedData);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

    }
}
