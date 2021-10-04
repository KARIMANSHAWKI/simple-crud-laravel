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
        $data = Category::create($request->all());
        if ($data) {
            return $this->successResponse($data);
        } else {
            return $this->errorResponse();
        }
    }/*
        end of store a category
    */


    public function show($id)
    {
        $category = Category::where("id", $id)->first();
        if ($category) {
            return $this->successResponse($category);
        }

        return $this->errorResponse();
    }/*
        end of show a $category
    */


    public function update(CategoryRequest $request, $id)
    {
        $category = Category::where("id", $id)->first();
        if ($category) {
            $result = $category->update($request->all());
            return $this->successResponse($result);
        }

        return $this->errorResponse();
    }/*
        end of update a ca$category
    */

    public function destroy($id)
    {
            $category = Category::where("id", $id)->first();
            if($category){
                $result = $category->delete();
                return $this->successResponse($result);
            }
            return $this->errorResponse();
    }/*
        end of delete a category
    */
}
