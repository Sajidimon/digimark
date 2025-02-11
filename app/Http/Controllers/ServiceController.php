<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return Inertia::render('Admin/Services/Services', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Admin/Services/AddService', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'delivery_time' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('images', time() . '_' . $request->file('image')->getClientOriginalName(), 'public');
        } else {
            $path = null;
        }

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'delivery_time' => $request->delivery_time,
            'image' => $path,
        ]);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show($serviceName)
    {
        $cart = session()->get('cart', []);
        $service = Service::where('name', '=', $serviceName)->firstOrFail();
        return Inertia::render('User/Home/SingleService', [
            'cart'=>$cart,
            'service'=>$service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $categories = Category::all();
        return Inertia::render('Admin/Services/EditService', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'category_id' => 'required',
            'description' => 'nullable|string',
            'delivery_time' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $service = Service::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $validatedData['image'] = $path;
        } else {
            $validatedData['image'] = $service->image;
        }

        $service->update($validatedData);

        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

    }
}
