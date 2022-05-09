<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return App\Models\User::find(1)->profile->avataro;
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'post'], function () {
        Route::get('/create', [App\Http\Controllers\PostsController::class, 'create'])->name('post.create');
        Route::post('/store', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');
    });

    Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'list'])->name('categories');
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
    Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::get('/posts', [App\Http\Controllers\PostsController::class, 'list'])->name('posts');
    Route::get('/post/edit/{id}', [App\Http\Controllers\PostsController::class, 'edit'])->name('post.edit');
    Route::get('/post/delete/{id}', [App\Http\Controllers\PostsController::class, 'delete'])->name('post.delete');
    Route::post('/post/update/{id}', [App\Http\Controllers\PostsController::class, 'update'])->name('posts.update');
    Route::get('/posts/trashed', [App\Http\Controllers\PostsController::class, 'trashed'])->name('posts.trashed');
    Route::get('/post/kill/{id}', [App\Http\Controllers\PostsController::class, 'kill'])->name('post.kill');
    Route::get('/post/restore/{id}', [App\Http\Controllers\PostsController::class, 'restore'])->name('post.restore');
    Route::get('/tags', [App\Http\Controllers\TagsController::class, 'index'])->name('tags');
    Route::get('/tag/edit/{id}', [App\Http\Controllers\TagsController::class, 'edit'])->name('tag.edit');
    Route::get('/tag/delete/{id}', [App\Http\Controllers\TagsController::class, 'destroy'])->name('tag.delete');
    Route::post('/tag/update/{id}', [App\Http\Controllers\TagsController::class, 'update'])->name('tag.update');
    Route::get('/tag/create', [App\Http\Controllers\TagsController::class, 'create'])->name('tag.create');
    Route::post('/tag/store', [App\Http\Controllers\TagsController::class, 'store'])->name('tag.store');
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
    Route::get('/users/delete/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('user.delete');
    Route::post('/user/store', [App\Http\Controllers\UsersController::class, 'store'])->name('user.store');
    Route::get('/user/create', [App\Http\Controllers\UsersController::class, 'create'])->name('user.create');
    Route::get('/users/admin/{id}', [App\Http\Controllers\UsersController::class, 'admin'])->name('user.admin')->middleware('admin');
    Route::get('/users/not_admin/{id}', [App\Http\Controllers\UsersController::class, 'not_admin'])->name('user.not_admin');

});
