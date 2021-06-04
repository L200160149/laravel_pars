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

// // detail menggunakan slug
// Route::get('/posts/{slug}', 'PostController@show');
// detail menggunakan id (akses model = /posts/{post}) dan bisa menggunakan slug tetapi ditambahkan key:slug (sesuai kolom tabel database)
Route::get('/posts/{post:slug}', 'PostController@show');

Route::get('/contact', function () {
    return view('contact');
});

Route::view('/login', 'login');
Route::view('/about', 'about');