<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationErrorException;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ErrorResponse;
use App\Traits\SuccessResponse;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    // Traits
    use ErrorResponse;
    use SuccessResponse;


    public function index()
    {
        $products = Product::paginate();
        return $this->successResponse(new ProductCollection($products));
    }


    public function store(ProductRequest $request)
    {
        try{
            $product = Product::create($request->all());
            dd($product);
            return $this->successResponse(new ProductResource($product));
        }catch (\Exception $e){
            DB::rollback();
            dd(';;');
            // throw $exception->validationException();
        }

    }


    public function show($id)
    {

        try {
            $product = Product::findOrFail($id);
            return $this->successResponse(new ProductResource($product));
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        try {
            $result = $product->update($request->all());
            return $this->successResponse(new ProductResource($product));
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
