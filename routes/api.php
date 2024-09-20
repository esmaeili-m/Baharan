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
