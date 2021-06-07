<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(6);
        return view('/posts/index', ['posts' => $posts]);
        // // atau bisa menggunakan
        // return view('/posts/index', compact('posts'));
    }

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
        return view('posts.show', compact('post'));
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'title' => 'required|min:3|max:100',
            'body' => 'required'
        ]);

        // // ================= Cara 1 =====================
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = \Str::slug($request->title);
        // $post->body = $request->body;
        // $post->save();

        // // ================= Cara 2 =====================
        Post::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'body' => $request->body
        ]);

        // // ================= Cara 3  =====================
        //     // jika tidak terdapat slug
        // Post::create($request->all());
        //     // jika terdapat slug
        // $post = $request->all();
        // $post['slug'] = \Str::slug($request->title);
        // Post::create($post);

        // // ================= Cara 4 (clean code dengan validasi)  =====================
                // =============== dengan syarat semua field harus ada validasinya ======================
        // $attr = $request->validate([
        //     'title' => 'required|min:3|max:100',
        //     'body' => 'required'
        // ]);

        // $attr['slug'] = \Str::slug($request->title);

        // Post::create($attr);


        session()->flash('success', 'Post berhasil ditambahkan.');

        return redirect()->to('posts');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $attr = request()->validate([
            'title' => 'required|min:3|max:100',
            'body' => 'required'
        ]);

        $post->update($attr);

        session()->flash('success', 'Post berhasil diupdate.');

        return redirect()->to('posts');
    }
}
