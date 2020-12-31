<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category, Tag, Comment};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $posts = Post::latest()->paginate(5);
        if(request('keyword')){
            $keyword = request('keyword');
            $posts = Post::where("title", "like", "%$keyword%")->latest()->paginate(5);
        }
        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'post'          => new Post,
            'categories'    => Category::get(),
            'tags'          => Tag::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation();

        $thumbnail = $request->file('thumbnail') ? $request->file('thumbnail')->store("images/posts") : null ;

        $data['thumbnail'] = $thumbnail;
        $data['slug'] = Str::slug($request->title);
        $data['category_id'] = $request->category;

        $post = auth()->user()->posts()->create($data);

        $post->tags()->attach(request('tags'));

        return redirect('/')->with('success', 'Success created new post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', [
            'post'          => $post,
            'categories'    => Category::get(),
            'tags'          => Tag::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $this->validation();

        if($request->file('thumbnail')){
            \Storage::delete($post->thumbnail);
            $thumbnail = $request->file('thumbnail')->store("images/posts");
        } else{
            $thumbnail = $post->thumbnail;
        }

        $data['category_id'] = $request->category;
        $data['thumbnail'] = $thumbnail;

        $post->update($data);

        $post->tags()->sync($request->tags);

        return redirect('/')->with('success', 'Success edited your post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->comments()->delete();
        $post->delete();
        return redirect('/')->with('success', 'Success deleted your post');
    }

    public function validation(){
        return request()->validate([
            'thumbnail'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'         => 'required',
            'body'          => 'required',
            'category'      => 'required',
            'tags'          => 'array|required',
        ]);
    }
}
