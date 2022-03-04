<?php

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

Route::get('/', [UserController::class , 'index']) -> name('user.index');

Route::get('/user/new', [UserController::class, 'newUserForm']) -> name('user.new.form');


Route::post('/user/create', [UserController::class, 'createNewUser']) -> name('user.create');
