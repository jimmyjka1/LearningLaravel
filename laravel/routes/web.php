<?php

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
    return 'HomePage';
}) -> name('home.index');

Route::get('/contact', function () {
    return 'Contact Page';
}) -> name('home.contact');


Route::get('/posts/{id}', function ($id) {
    return 'Post id=' . $id;
})
// -> where([
//     'id' => '[0-9]+'
// ])
-> name('posts');

Route::get('/recent-posts/{num_days?}', function ($num_days = 20){
    return 'Viewing Post from ' . $num_days . ' ago';
});




