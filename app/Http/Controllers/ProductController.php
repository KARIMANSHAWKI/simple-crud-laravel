<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Exceptions\Exception;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            "success" => true,
            "products" => $products
            ]);
    }/*
        end of list products
    */


    public function store(ProductRequest $request)
    {
        try {
            Product::create($request->all());
            return response()->json([
                "success" => true,
                ]);
        } catch (\Exception $e) {
            $this->errorResult($e);
        }
    }/*
        end of store a product
    */


    public function show($id)
    {
        $product = Product::where("id", $id)->first();
        return response()->json([
            "success" => true,
            "data" => $product
            ]);
    }/*
        end of show a product
    */


    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::where("id", $id)->first();
            $product->update($request->all());
        } catch (\Exception $e) {
            $this->errorResult($e);
        }
    }/*
        end of update a product
    */


    public function destroy(Product $product)
    {
        try{
            $product = Product::where("id", $id)->first();
            $product->delete();
        }catch(\Exception $e){
            $this->errorResult($e);
        }
    }/*
        end of delete a product
    */


    public function errorResult(\Exception $e){
        return response()->json([
            "success" => false,
            "message" => $e->getMessage()
            ]);
    }/*
        end of handle err message 
    */
}
