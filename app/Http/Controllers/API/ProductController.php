<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(3);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

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

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        };

        //get the "ID" of currently authenticated user and assign it to the "product_creator_id"
        $data['creator_id'] = auth()->id();

        $product = Product::create($data);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        $product->load('category');

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::where('id', $id)->first();

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

        $data = $request->all();

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if the currently authenticated user has permissions for the "update" action
        $this->authorize('update', $product);

        $product->update($data);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json(null, 204);
    }
}
