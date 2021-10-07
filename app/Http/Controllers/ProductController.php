<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ErrorResponse;
use App\Traits\SuccessResponse;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    // Traits
    use ErrorResponse;
    use SuccessResponse;


    public function index()
    {
        $products = Product::all();
        return $this->successResponse($products);
    }/*
        end of list products
    */


    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->all());
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }/*
        end of store a product
    */


    public function show($id)
    {
        try {
            $product = Product::where("id", $id)->firstOrFail();
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }/*
        end of show a product
    */


    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::where("id", $id)->firstOrFail();
            $result = $product->update($request->all());
            return $this->successResponse($result);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }/*
        end of update a product
    */


    public function destroy($id)
    {
        try {
            $product = Product::where("id", $id)->firstOrFail();
            $result = $product->delete();
            return $this->successResponse($result);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }/*
        end of delete a product
    */
}
