<?php

use App\Http\Controllers\ProductController;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {

    $brands = Brand::all();
    $categories = Category::all();

    $num_rows = $request -> all()['num_rows'] ?? 10;
    $page = $request -> all()['page'] ?? 1;
    $sort_column = $request -> all()['sort_column'] ?? 'id';
    $sort_direction = $request -> all()['sort_direction'] ?? 'ASC';


    return view('welcome', compact('brands', 'categories', 'num_rows', 'page', 'sort_column', 'sort_direction'));
});


Route::resource('/product', ProductController::class);