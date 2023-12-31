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

        $rules = [
            "title" => "required | min:2",
            "description" => "nullable | string",
            "price" => "required | numeric",
            "image_url" => "required",
            "category_id" => "required",
        ];
        $message = [
            "title.required" => "Title field is required",
            "title.min" => "Title input must have more than 1 character",
            "description.required" => "Description field is required",
            "price.required" => "Price field is required",
            "price.numeric" => "Price input must have numbers only",
            "image_url.required" => "Image field is required",
            "category_id.required" => "Category field is required",
        ];
        $data = $request->validate($rules, $message);

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
        // $user = auth()->user();

        // if ($user->id != $product->creator_id  && $user->role != "admin") {
        //     abort(403, 'Unauthorized action.');
        // }

        $this->authorize('update', $product);

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //get the currently authenticated user and assign it to the "user"
        // $user = auth()->user();

        // if ($user->id != $product->creator_id  && $user->role != "admin") {
        //     abort(403, 'Unauthorized action.');
        // }

        $product = Product::where("id", $id)->first();

        $rules = [
            "title" => "required | min:2",
            "description" => "nullable | string",
            "price" => "required | numeric",
            "image_url" => "required",
            "category_id" => "required"
        ];
        $message = [
            "title.required" => "Title field is required",
            "title.min" => "Title input must have more than 1 character",
            "description.required" => "Description field is required",
            "price.required" => "Price field is required",
            "price.numeric" => "Price input must have numbers only",
            "image_url.required" => "Image field is required",
            "category_id.required" => "Category field is required",
        ];

        $data = $request->validate($rules, $message);

        //check if the currently authenticated user have permissions for the "update" action 
        $this->authorize('update', $product);

        $product->update($data);


        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get the currently authenticated user and assign it to the "user"
        // $user = auth()->user();

        // if ($user->id != $product->creator_id  && $user->role != "admin") {
        //     abort(403, 'Unauthorized action.');
        // }
        $product = Product::findOrFail($id);

        //check if the currently authenticated user have permissions for the "delete" action 
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index');
    }
}
