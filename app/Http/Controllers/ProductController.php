<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ErrorResponse;
use App\Traits\SuccessResponse;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    // Traits
    use ErrorResponse;
    use SuccessResponse;


    public function index()
    {
        $products = Product::all();
        return $this->successResponse($products);
    }


    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->all());
            return $this->successResponse(new ProductResource($product));
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        try {
            return $this->successResponse(new ProductResource($product));
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::where("id", $id)->firstOrFail();
            $result = $product->update($request->all());
            return $this->successResponse($result);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function destroy($id)
    {
        try {
            $product = Product::where("id", $id)->firstOrFail();
            $result = $product->delete();
            return $this->successResponse($result);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
