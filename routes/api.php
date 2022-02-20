<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PayOrderController;
use App\Hello\HelloFacade;
use App\Http\Controllers\MailController;


//Route::middleware('auth:sanctum')->group(function (){
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
//});

Route::post('/pay', [PayOrderController::class, 'store']);
Route::get('/pay', [PayOrderController::class, 'index']);

Route::get('/hello', function (){
    return HelloFacade::sayHello('karmen1');
});

Route::get('/send-mail',  [MailController::class, 'send']);



//searching
Route::get('/search', [ProductController::class, 'search']);



