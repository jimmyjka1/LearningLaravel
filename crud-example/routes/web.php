<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

// Route::get('/', [HomeController::class, 'index']) -> name('home');
Route::get('/', function(){
    return redirect() -> route('post.index');
}) -> name('home');


Route::prefix('user/') -> name('user.') -> group(function(){
    Route::get('login', [UserController::class, 'loginPage']) -> name('login_page');
    Route::post('login', [UserController::class, 'login']) -> name('login');
    Route::get('logout', [UserController::class, 'logout']) -> name('logout');
});
Route::resource('user', UserController::class);
Route::resource('post', PostController::class);



Route::prefix('like-post/') -> name('like_post.') -> group(function (){
    Route::post('like/',[LikeController::class, 'like']) -> name('like');
    Route::post('dislike/', [LikeController::class, 'dislike']) -> name('dislike');
});


Route::prefix('comment/') -> name('comment.') -> group(function (){
    Route::post('add/', [CommentController::class, 'add_comment']) -> name('add');
    Route::post('delete/', [CommentController::class, 'delete_comment']) -> name('delete');
});