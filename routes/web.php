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
    return App\Models\User::where('id',1)->first();
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'post'], function () {
        Route::get('/create', [App\Http\Controllers\PostsController::class, 'create'])->name('post.create');
        Route::post('/store', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');
        Route::get('/edit/{id}', [App\Http\Controllers\PostsController::class, 'edit'])->name('post.edit');
        Route::get('/delete/{id}', [App\Http\Controllers\PostsController::class, 'delete'])->name('post.delete');
        Route::post('/update/{id}', [App\Http\Controllers\PostsController::class, 'update'])->name('posts.update');
        Route::get('/trashed', [App\Http\Controllers\PostsController::class, 'trashed'])->name('post.trashed');
        Route::get('/kill/{id}', [App\Http\Controllers\PostsController::class, 'kill'])->name('post.kill');
        Route::get('/restore/{id}', [App\Http\Controllers\PostsController::class, 'restore'])->name('post.restore');
    });

    Route::group(['prefix'=>'categories'], function (){
        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::get('/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('categories.delete');
        Route::post('/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    });

    Route::group(['prefix'=>'tag'], function () {
        Route::get('/edit/{id}', [App\Http\Controllers\TagController::class, 'edit'])->name('tag.edit');
        Route::get('/delete/{id}', [App\Http\Controllers\TagController::class, 'destroy'])->name('tag.delete');
        Route::post('/update/{id}', [App\Http\Controllers\TagController::class, 'update'])->name('tag.update');
        Route::get('/create', [App\Http\Controllers\TagController::class, 'create'])->name('tag.create');
        Route::post('/store', [App\Http\Controllers\TagController::class, 'store'])->name('tag.store');
    });

    Route::group(['prefix'=>'user'], function () {
        Route::get('/delete/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('user.delete');
        Route::post('/store', [App\Http\Controllers\UsersController::class, 'store'])->name('user.store');
        Route::get('/create', [App\Http\Controllers\UsersController::class, 'create'])->name('user.create');
        Route::get('/admin/{id}', [App\Http\Controllers\UsersController::class, 'admin'])->name('user.admin')->middleware('admin');
        Route::get('/not_admin/{id}', [App\Http\Controllers\UsersController::class, 'not_admin'])->name('user.not_admin');
        Route::get('/profiles/{id}', [App\Http\Controllers\ProfileController::class, 'index'])->name('user.profile');
        Route::post('/profiles/update/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('users.profile');

    });
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'list'])->name('categories');
    Route::get('/posts', [App\Http\Controllers\PostsController::class, 'list'])->name('posts');
    Route::get('/tags', [App\Http\Controllers\TagController::class, 'index'])->name('tags');
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
