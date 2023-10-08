<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $categories = Category::all();
        $categories = Category::paginate(6);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Category::create($request->all());

        $image = $request->file('logo');

        $imageName = $image->getClientOriginalName();

        $image->move(public_path('assets/images'), $imageName);

        $data = $request->all();

        $data['logo'] = $imageName;

        Category::create($data);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        $products = $category->products;
        return view('categories.show', compact('category', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {

            $image = $request->file('logo');

            $imageName = $image->getClientOriginalName();

            $image->move(public_path('assets/images'), $imageName);

            $data['logo'] = $imageName;
        }

        $category->update($data);

        return redirect()->route('categories.index');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->delete();
        return redirect()->route('categories.index');
    }
}
