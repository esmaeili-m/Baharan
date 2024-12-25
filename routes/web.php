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

Route::get('/',\App\Livewire\Home\Auth\Login::class)->name('user.login');
Route::get('/forbiden/403/',\App\Livewire\Home\Forbiden::class)->name('forbiden.403');
Route::get('/redirect/{token}/{method}',\App\Livewire\Home\Redirect::class)->name('redirect');

Route::prefix('home')->group(function (){
    Route::post('home/get_code',[\App\Http\Controllers\LoginController::class,'get_code'])->name('get_code');
    Route::get('login/user',\App\Livewire\Home\Auth\Login::class)->name('user.login');

    ///////////////////////////Shop//////////////////////////////////
    Route::get('/shop',\App\Livewire\Home\Shop\Index::class)->name('shop.index')->middleware('auth');
    ///////////////////////////Profile//////////////////////////////////
    Route::get('profile',\App\Livewire\Home\Profile\Index::class)->name('profile.index')->middleware('auth');
    //////
    Route::post('/receipt',[\App\Http\Controllers\AuthOtpController::class,'receipt']);
    ///
});
