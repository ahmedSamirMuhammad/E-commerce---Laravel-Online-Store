<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $products = Product::all();
        $products = Product::paginate(3);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $category_id = $request->input('category_id');
        $data['category_id'] = $category_id;

        //get the "ID" of currently authenticated user and assign it to the "product_creator_id"
        $data['creator_id'] = auth()->id();

        Product::create($data);

        return redirect()->route('products.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $product = Product::findOrFail($id);
        // return view('products.show', ["product"=>$product]);


        $product = Product::findOrFail($id);
        $category = $product->category;

        return view('products.show', compact("product", "category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        //get the currently authenticated user and assign it to the "user"
        $user = auth()->user();

        if ($user->id != $product->creator_id  && $user->role != "admin") {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $product = Product::findOrFail($id);

        // $product->update($request->all());

        $product = Product::where("id", $id)->first();

        //get the currently authenticated user and assign it to the "user"
        $user = auth()->user();

        if ($user->id != $product->creator_id  && $user->role != "admin") {
            abort(403, 'Unauthorized action.');
        }

        $product->update($request->all());


        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        //get the currently authenticated user and assign it to the "user"
        $user = auth()->user();

        if ($user->id != $product->creator_id  && $user->role != "admin") {
            abort(403, 'Unauthorized action.');
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
