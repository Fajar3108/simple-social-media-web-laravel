<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Tag, Category};

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $categories = Category::get();
        $posts = $tag->posts()->latest()->paginate(5);
        return view('posts.index', compact('posts', 'tag', 'categories'));
    }
}
