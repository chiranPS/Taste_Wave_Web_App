<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => true,
            'products' => ProductResource::collection($products)
        ], 200);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'image' => 'required|string',
            'product_price' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
            'food_category' => 'required|string',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $product = Product::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Product Created Successfully',
            'product' => new ProductResource($product)
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product Not Found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'product' => new ProductResource($product)
        ], 200);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product Not Found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'product_name' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'product_price' => 'nullable|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
            'food_category' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $product->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Product Updated Successfully',
            'product' => new ProductResource($product)
        ], 200);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product Not Found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product Deleted Successfully'
        ], 200);
    }
}
