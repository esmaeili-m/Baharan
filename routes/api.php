<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//------------------------------------->Users
Route::post('/get_code',[\App\Http\Controllers\AuthOtpController::class,'get_code']);
Route::post('/check_code',[\App\Http\Controllers\AuthOtpController::class,'check_code']);
Route::post('/user/create',[\App\Http\Controllers\AuthOtpController::class,'create']);
//------------------------------------->Category
Route::get('/categories',[\App\Http\Controllers\CategoryController::class,'categories']);
Route::get('/category/{id}',[\App\Http\Controllers\CategoryController::class,'category']);
Route::get('/categories/products',[\App\Http\Controllers\CategoryController::class,'category_products']);
//------------------------------------->Products
Route::get('/products',[\App\Http\Controllers\ProductController::class,'products']);
Route::get('/product/{id}',[\App\Http\Controllers\ProductController::class,'product']);
Route::get('/products/category',[\App\Http\Controllers\ProductController::class,'products_category']);
//------------------------------------->Invoices
Route::post('/order/create',[\App\Http\Controllers\OrderController::class,'create'])->middleware('check_token');
Route::post('/order/update',[\App\Http\Controllers\OrderController::class,'update']);
Route::post('/order/get_invoice',[\App\Http\Controllers\OrderController::class,'get_invoice'])->middleware('check_token');;
Route::get('/order/get_invoices',[\App\Http\Controllers\OrderController::class,'get_invoices'])->middleware('check_token');;
//------------------------------------->Products
Route::post('/chat/create',[\App\Http\Controllers\ChatController::class,'create'])->middleware('check_token');
Route::post('/chat/create_message',[\App\Http\Controllers\ChatController::class,'create_message'])->middleware('check_token');
Route::post('/chat/messages',[\App\Http\Controllers\ChatController::class,'messages'])->middleware('check_token');
Route::get('/chat/chats',[\App\Http\Controllers\ChatController::class,'chats'])->middleware('check_token');
//------------------------------------->Setting

Route::get('/setting',[\App\Http\Controllers\ChatController::class,'setting'])->middleware('check_token');


