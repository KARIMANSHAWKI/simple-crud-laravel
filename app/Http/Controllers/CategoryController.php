<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ErrorResponse;
use App\Traits\SuccessResponse;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
   // Traits
   use ErrorResponse;
   use SuccessResponse;


   public function index()
   {
       $categories = Category::all();
       return $this->successResponse($categories);
   }/*
       end of list categories
   */


    public function store(CategoryRequest $request)
    {
        try {
            $data = Category::create($request->all());
            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }/*
        end of store a category
    */


    public function show($id)
    {
        try {
            $category = Category::where("id", $id)->firstOrFail();
            return $this->successResponse($category);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }/*
        end of show a $category
    */


    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::where("id", $id)->firstOrFail();
            $result = $category->update($request->all());
            return $this->successResponse($result);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }/*
        end of update a ca$category
    */

    public function destroy($id)
    {
        try {
            $category = Category::where("id", $id)->firstOrFail();
            $result = $category->delete();
            return $this->successResponse($result);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }/*
        end of delete a category
    */
}
