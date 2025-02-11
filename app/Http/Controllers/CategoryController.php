<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return Inertia::render('Admin/Categories/Categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Categories/AddCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $path = null;

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->storeAs('images', time() . '_' . $request->file('thumbnail')->getClientOriginalName(), 'public');
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $path,
        ]);

        return redirect()->back()->with('success', 'Category created successfull');

    }

    /**
     * Display the specified resource.
     */
    public function show($categoryName)
    {
        $category = Category::where('name', '=', $categoryName)->with('products')->firstOrFail();
        return Inertia::render('Admin/Categories/ViewCategory', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return Inertia::render('Admin/Categories/EditCategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $category = Category::findOrFail($id);

        if($request->hasFile('thumbnail')){
            if ($category->thumbnail) {
                Storage::disk('public')->delete($category->thumbnail);
            }

        $filename = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
        $path = $request->file('thumbnail')->storeAs('images', $filename, 'public' );
        $validatedData['thumbnail'] = $path;
        
        }else{
            $validatedData['thumbnail'] = $category->thumbnail;
        }

        $category->update($validatedData);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if($category->thumbnail){
            Storage::disk('public')->delete($category->thumbnail);
        }

        $category->delete();

        return redirect()->back()->with('success', 'category deleted successfull');
    }
}
