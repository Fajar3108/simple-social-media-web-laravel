<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $categories = Category::get();
        $posts = $category->posts()->latest()->paginate(5);
        return view('posts.index', compact('posts', 'category', 'categories'));
    }
}
