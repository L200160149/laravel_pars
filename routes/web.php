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

Route::get('/', 'HomeController');


Route::get('/posts', 'PostController@index');

// insert
Route::get('/posts/create', 'PostController@create');
Route::post('/posts/store', 'PostController@store');

// update
Route::get('/posts/{post:slug}/edit', 'PostController@edit');
Route::patch('/posts/{post:slug}/edit', 'PostController@update');

// delete
Route::delete('/posts/{post:slug}/delete', 'PostController@delete');


// // detail menggunakan slug
// Route::get('/posts/{slug}', 'PostController@show');
// detail menggunakan id (akses model = /posts/{post}) dan bisa menggunakan slug tetapi ditambahkan key:slug (sesuai kolom tabel database)
Route::get('/posts/{post:slug}', 'PostController@show');


Route::get('categories/{category:slug}', 'CategoryController@show');

Route::get('tags/{tag:slug}', 'TagController@show');


Route::get('/contact', function () {
    return view('contact');
});

Route::view('/login', 'login');
Route::view('/about', 'about');
