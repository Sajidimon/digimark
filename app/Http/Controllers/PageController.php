<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return Inertia::render('Admin/Pages/Pages', [
            'pages' => $pages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Pages/CreatePage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        Page::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($pageName)
    {
        $page = Page::where('name', '=', $pageName)->firstOrFail();
        
        return Inertia::render('Admin/Pages/ViewPage', [
            'page' => $page,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return Inertia::render('Admin/Pages/EditPage', [
            'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $page = Page::findOrFail($id);

        $page->update($validatedData);

        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return redirect()->back();
    }
}
