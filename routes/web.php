<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('home')->group(function (){
    Route::post('home/get_code',[\App\Http\Controllers\LoginController::class,'get_code'])->name('get_code');
    Route::get('login/user',\App\Livewire\Home\Auth\Login::class)->name('user.login');

    ///////////////////////////Shop//////////////////////////////////
    Route::get('/shop',\App\Livewire\Home\Shop\Index::class)->name('shop.index');
    ///////////////////////////Profile//////////////////////////////////
    Route::get('profile',\App\Livewire\Home\Profile\Index::class)->name('profile.index');
});
