<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'post', 'middleware' => 'auth'], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts');
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
    Route::post('/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/single_post/{slug}', [PostController::class, 'show'])->name('single_post');

    Route::post('/',[CommentController::class,'store'])->name('comment.store');
    Route::get('/delete/{id}', [CommentController::class, 'destroy'])->name('comment.delete');
    Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('/update/{id}', [CommentController::class, 'update'])->name('comment.update');

});

