<?php

use Illuminate\Support\Facades\Route;

// // untuk akses View tanpa Controller
// Route::view('url', 'views');

// Route::get('/contact', function() {
//     // // mengambil semua url
//     // request()->fullUrl();

//     // // cara 1
//     // return request()->path() == 'contact' ? true : false;
//     // cara 2
//     return request()->is('contact') ? true : false;
// });

// Route::get('/', function () {
//     return view('home');
// });


// // // menggunakan name routing dan memberi hak akses pada function controller
// // Route::get('/posts', 'PostController@index')->middleware('auth')->name('posts.index');
// Route::get('/posts', 'PostController@index')->middleware('auth')->name('posts.index');
// // insert
// Route::get('/posts/create', 'PostController@create')->name('posts.create');
// Route::post('/posts/store', 'PostController@store');
// // update
// Route::get('/posts/{post:slug}/edit', 'PostController@edit');
// Route::patch('/posts/{post:slug}/edit', 'PostController@update');
// // delete
// Route::delete('/posts/{post:slug}/delete', 'PostController@delete');
// // // detail menggunakan slug
// // Route::get('/posts/{slug}', 'PostController@show');
// // detail menggunakan id (akses model = /posts/{post}) dan bisa menggunakan slug tetapi ditambahkan key:slug (sesuai kolom tabel database)
// Route::get('/posts/{post:slug}', 'PostController@show');


Route::get('categories/{category:slug}', 'CategoryController@show');

Route::get('tags/{tag:slug}', 'TagController@show');


Route::get('/contact', function () {
    return view('contact');
});

Route::view('/login', 'login');
Route::view('/about', 'about');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function() {
    Route::get('/posts', 'PostController@index')->name('posts.index')->withoutMiddleware('auth');
    // insert
    Route::get('/posts/create', 'PostController@create')->name('posts.create');
    Route::post('/posts/store', 'PostController@store');
    // update
    Route::get('/posts/{post:slug}/edit', 'PostController@edit');
    Route::patch('/posts/{post:slug}/edit', 'PostController@update');
    // delete
    Route::delete('/posts/{post:slug}/delete', 'PostController@delete');
    // // detail menggunakan slug
    // Route::get('/posts/{slug}', 'PostController@show');
    // detail menggunakan id (akses model = /posts/{post}) dan bisa menggunakan slug tetapi ditambahkan key:slug (sesuai kolom tabel database)
    Route::get('/posts/{post:slug}', 'PostController@show')->withoutMiddleware('auth');
});