<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // memanggil method posts() /builder pada category model
        $posts = $category->posts()->latest()->paginate(6);

        return view('posts.index', compact(['posts', 'category']));
    }
}
