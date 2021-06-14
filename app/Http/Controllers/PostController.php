<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostController extends Controller
{

    public function __construct()
    {
        // validasi selain function index dan show maka pengunjung harus login
        // $this->middleware('auth')->except([
        //     'index', 'show'
        // ]);
    }

    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts/index', ['posts' => $posts]);
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
        return view('posts.create', [
            'post' => new Post(),
            // mengambil data kategori dari database
            'categories' => Category::get(),
            // mengambil data tag dari database
            'tags' => Tag::get()
        ]);
    }

    public function store(Request $request)
    {
        // validasi
        $attr = request()->validate([
            'title' => 'required|min:3|max:100',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required'
        ]);
        // // ================= Cara 1 =====================
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = \Str::slug($request->title);
        // $post->body = $request->body;
        // $post->save();

        // // ================= Cara 2 =====================

        $attr['slug'] = \Str::slug(request('title'));
        
        // input category_id ke tabel posts
        $attr['category_id'] = request('category');

        // // cara sebelum input session id
        // $post = Post::create($attr);

        // input session id
        $post = auth()->user()->posts()->create($attr);


        // input category_id ke tabel posts
        $post->tags()->attach(request('tags'));



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


        // // =================== Cara 5 =========================
        // Post::create([
        //     'title' => $request->title,
        //     'slug' => \Str::slug($request->title),
        //     'body' => $request->body
        // ]);


        session()->flash('success', 'Post berhasil ditambahkan.');

        return redirect()->to('posts');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            // mengambil data kategori dari database
            'categories' => Category::get(),
            // mengambil data tag dari database
            'tags' => Tag::get()
        ]);
    }

    public function update(Post $post)
    {
        // cek hanya author yang bisa edit postnya (menggunakan policy)
        $this->authorize('update', $post);

        $attr = request()->validate([
            'title' => 'required|min:3|max:100',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required'
        ]);

        $attr['category_id'] = request('category');

        $post->update($attr);
        // input category_id ke tabel posts
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'Post berhasil diupdate.');

        return redirect()->to('posts');
    }

    public function delete(Post $post)
    {
        // // cara 1 = menghapus relasi many to many
        // $post->tags()->detach();
        // $post->delete();
        // session()->flash('success', 'Post berhasil dihapus.');
        // return redirect()->to('posts');

        // cara 2 = menghapus post sendiri
        if(auth()->user()->is($post->author)) {
            $post->tags()->detach();
            $post->delete();
            session()->flash('success', 'Post berhasil dihapus.');
            return redirect()->to('posts');
        } else {
            session()->flash('success', 'Itu bukan postmu.');
            return redirect()->to('posts');
        }

        // // cara 3 = menggunakan policy (sama seperti cara 2 hanya lebih singkat codenya)
        // $this->authorize('update', $post);
        // session()->flash("success", "Post berhasil dihapus");
        // return redirect('posts');
    }
}
