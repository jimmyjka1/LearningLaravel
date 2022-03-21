<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\URL;

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

Route::get('/', [HomeController::class, 'index'])->name("home.index");
// Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/single', AboutController::class);
Route::get('/signedURL', function (Request $request) {


    if ($request->hasValidSignature()) {
        return "Valid Signed URL";
    } else {
        return "Invalid Signed URL";
    }
})->name('home.signed');
// Route::view('/', 'home.index')
//     ->name('home.index');
// Route::view('/contact', 'home.contact')
//     ->name('home.contact');



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


// Route::get('/posts/{id}', function ($id) use ($posts) {


//     abort_if(!isset($posts[$id]), 404);
//     return view('posts.show', ['post' => $posts[$id]]);
// })->name("posts.show");

// Route::get('/posts', function () use ($posts) {
//     // compact($posts) == ['posts' => $posts]
//     return view('posts.index', ['posts' => $posts]);
// })->name('posts.index');
// // ->where([
// //     'id' => '[0-9]+'
// // ])

// Route::get('/recent-posts/{days_ago?}', function ($days_ago = 20) {
//     return 'Posts from ' . $days_ago . ' days ago';
// })->name('posts.recent.index');

Route::resource('posts', PostsController::class);



Route::prefix('/fun')->name('fun.')->group(function () use ($posts) {


    Route::get('/responses', function () use ($posts) {
        return response($posts, 201)
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIE', 'Jimmy Kumar Ahalapra', 3600);
    })->name('responses');

    Route::get('/redirect', function () {
        return redirect('contact');
    })->name('redirect');


    Route::get('/back', function () {
        return back();
    })->name('back');

    Route::get('/named-route/', function ($id = 1) {
        return redirect()->route('posts.show', ['id' => $id]);
    })->name('named-route');

    Route::get('/away', function () {
        return redirect()->away('https://www.google.com');
    })->name('away');

    Route::get('/json', function () use ($posts) {
        return response()->json($posts);
    })->name('json');

    Route::get('/download', function () {
        return response()->download(public_path('/daniel.jpg', 'pratyush.jpg'));
    })->name('download');


    Route::get('/signed-route', function () {
        return URL::signedRoute('home.signed');
    })->name('signed-route');
});

Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
