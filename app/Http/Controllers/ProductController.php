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
        $data = Product::create($request->all());
        if ($data) {
            return $this->successResponse($data);
        } else {
            return $this->errorResponse();
        }
    }/*
        end of store a product
    */


    public function show($id)
    {
        $product = Product::where("id", $id)->first();
        if ($product) {
            return $this->successResponse($product);
        }

        return $this->errorResponse();
    }/*
        end of show a product
    */


    public function update(ProductRequest $request, $id)
    {
        $product = Product::where("id", $id)->first();
        if ($product) {
            $result = $product->update($request->all());
            return $this->successResponse($result);
        }

        return $this->errorResponse();
    }/*
        end of update a product
    */


    public function destroy($id)
    {
            $product = Product::where("id", $id)->first();
            if($product){
                $result = $product->delete();
                return $this->successResponse($result);
            }
            return $this->errorResponse();
    }/*
        end of delete a product
    */
}
