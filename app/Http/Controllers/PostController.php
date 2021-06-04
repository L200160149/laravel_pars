<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{  
    // // akses detail menggunakan slug
    // public function show($slug)
    // {
    //     $post = Post::where('slug',$slug)->first();

    //     // Jika data post tidak ada di database
    //         // atau bisa menggunakan method firstOrFail();
    //     if (!$post) {
    //         abort(404);
    //     }

    //     return view('posts.post',compact('post'));
    // }

    // akses detail menggunakan id (dan slug juga bisa tetapi di web.php ditambahkan key:slug)
    public function show(Post $post)
    {
        return view('posts.post', compact('post'));
    }
}
