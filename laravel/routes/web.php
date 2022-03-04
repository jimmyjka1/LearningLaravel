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

// Route::get('/', function () {
//     return view('home.index', []);
// })->name("home.index");
Route::view('/', 'home.index')
    ->name('home.index');
Route::view('/contact', 'home.contact')
    ->name('home.contact');


// Route::get('/contact', function() {
//     return view('home.contact', []);
// })->name('home.contact');

$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ],
    3 => [
        'title' => 'Intro to Go',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ]
];


Route::get('/posts/{id}', function($id) use ($posts) {
    
    
    abort_if(!isset($posts[$id]), 404);
    return view('posts.show', ['post' => $posts[$id]]);
})->name("posts.show");

Route::get('/posts', function() use ($posts) {
    // compact($posts) == ['posts' => $posts]
    return view('posts.index', ['posts' => $posts]);
})-> name('posts.index');
// ->where([
//     'id' => '[0-9]+'
// ])

Route::get('/recent-posts/{days_ago?}', function($days_ago = 20) {
    return 'Posts from ' . $days_ago . ' days ago';
})->name('posts.recent.index');


Route::get('/fun/responses', function() use ($posts){
    return response($posts, 201) 
    -> header('Content-Type', 'application/json')
    -> cookie('MY_COOKIE', 'Jimmy Kumar Ahalapra', 3600);
});

