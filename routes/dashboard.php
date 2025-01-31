<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth','check_role'])->group(function () {

    Route::get('/panel',\App\Livewire\Dashboard\Index::class)->name('dashboard');
//-------------------------------------------------------{ UploadImage } ---------------------------------------
    Route::post('/upload-image-tinymce', [\App\Http\Controllers\UploadController::class, 'upload_image_tinymc']);
//-------------------------------------------------------{ Users } ---------------------------------------
    Route::get('/user/list',\App\Livewire\Dashboard\Users\Index::class)->name('user.list');
    Route::get('/user/create',\App\Livewire\Dashboard\Users\Create::class)->name('user.create');
    Route::get('/user/update/{id}',\App\Livewire\Dashboard\Users\Update::class)->name('user.update');
    Route::get('/user/trash',\App\Livewire\Dashboard\Users\Trash::class)->name('user.trash');
//-------------------------------------------------------{ Products } ---------------------------------------
    Route::get('/product/list',\App\Livewire\Dashboard\Product\Index::class)->name('product.list');
    Route::get('/product/create',\App\Livewire\Dashboard\Product\Create::class)->name('product.create');
    Route::get('/product/update/{id}',\App\Livewire\Dashboard\Product\Update::class)->name('product.update');
    Route::get('/product/trash',\App\Livewire\Dashboard\Product\Trash::class)->name('product.trash');
//-------------------------------------------------------{ Category } ---------------------------------------
    Route::get('/category/list',\App\Livewire\Dashboard\Category\Index::class)->name('category.list');
    Route::get('/category/create',\App\Livewire\Dashboard\Category\Create::class)->name('category.create');
    Route::get('/category/update/{id}',\App\Livewire\Dashboard\Category\Update::class)->name('category.update');
    Route::get('/category/trash',\App\Livewire\Dashboard\Category\Trash::class)->name('category.trash');
//-------------------------------------------------------{ Role } ---------------------------------------
    Route::get('/role/list',\App\Livewire\Dashboard\Role\Index::class)->name('role.list');
    Route::get('/role/create',\App\Livewire\Dashboard\Role\Create::class)->name('role.create');
    Route::get('/role/update/{id}',\App\Livewire\Dashboard\Role\Update::class)->name('role.update');
    Route::get('/permission/{id}',\App\Livewire\Dashboard\Permission\Index::class)->name('role.permission');
//-------------------------------------------------------{ Messages } ---------------------------------------
    Route::get('/message/list',\App\Livewire\Dashboard\Messages\Index::class)->name('message.list');
    Route::get('/message/chats/{user}',\App\Livewire\Dashboard\Messages\User::class)->name('message.chats');
    //-------------------------------------------------------{ Invoice } ---------------------------------------
    Route::get('/invoice/list',\App\Livewire\Dashboard\Invoice\Index::class)->name('invoice.list');
    Route::get('/invoice/create',\App\Livewire\Dashboard\Invoice\Create::class)->name('invoice.create');
    Route::get('/invoice/details/{id}',\App\Livewire\Dashboard\Invoice\Details::class)->name('invoice.details');
    Route::get('/invoice/update/{id}',\App\Livewire\Dashboard\Invoice\Update::class)->name('invoice.update');
//-------------------------------------------------------{ Setting } ---------------------------------------
    Route::get('/setting',\App\Livewire\Dashboard\Setting::class)->name('setting');
//-------------------------------------------------------{ Logs } ---------------------------------------
    Route::get('/logs',\App\Livewire\Dashboard\Logs::class)->name('logs');

//-------------------------------------------------------{ Post } ---------------------------------------
    Route::get('/post/list',\App\Livewire\Dashboard\Post\Index::class)->name('post.list');
    Route::get('/post/create',\App\Livewire\Dashboard\Post\Create::class)->name('post.create');
    Route::get('/post/update/{id}',\App\Livewire\Dashboard\Post\Update::class)->name('post.update');
    Route::get('/post/gallery/{id}',\App\Livewire\Dashboard\Post\Gallery::class)->name('post.gallery');
    Route::get('/post/trash',\App\Livewire\Dashboard\Post\Trash::class)->name('post.trash');
//-------------------------------------------------------{ Service } ---------------------------------------
    Route::get('/service/list',\App\Livewire\Dashboard\Service\Index::class)->name('service.list');
    Route::get('/service/create',\App\Livewire\Dashboard\Service\Create::class)->name('service.create');
    Route::get('/service/update/{id}',\App\Livewire\Dashboard\Service\Update::class)->name('service.update');
    Route::get('/service/trash',\App\Livewire\Dashboard\Service\Trash::class)->name('service.trash');
//-------------------------------------------------------{ article } ---------------------------------------
    Route::get('/article/list',\App\Livewire\Dashboard\Article\Index::class)->name('article.list');
    Route::get('/article/create',\App\Livewire\Dashboard\Article\Create::class)->name('article.create');
    Route::get('/article/update/{id}',\App\Livewire\Dashboard\Article\Update::class)->name('article.update');
    Route::get('/article/trash',\App\Livewire\Dashboard\Article\Trash::class)->name('article.trash');
//-------------------------------------------------------{ tag } ---------------------------------------
    Route::get('/tag/list',\App\Livewire\Dashboard\Tag\Index::class)->name('tag.list');
    Route::get('/tag/trash',\App\Livewire\Dashboard\Tag\Trash::class)->name('tag.trash');

});
