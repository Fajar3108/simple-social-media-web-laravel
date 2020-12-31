@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="text-center mb-4">
            @if (isset($category))
            <h1 class="m-0">Catgeory : {{ $category->name }}</h1>
            @elseif(isset($tag))
            <h1>#{{ $tag->name }}</h1>
            @else
            <h1>All Post</h1>
            @endif
        </div>
        <div class="row">
            <div class="col-md-7 mx-auto mb-3">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="categoriesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter by category
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('/') }}">All Posts</a>
                        @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ url('categories/' . $category->slug) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <form action="{{ url('/') }}" method="GET" class="col-md-7 mx-auto">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search post by title" aria-label="Search post by title" aria-describedby="searchButton" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="searchButton">Search</button>
                    </div>
                </div>
            </form>
            @foreach ($posts as $post)
            <div class="col-md-7 mx-auto mb-3">
                <div class="card">
                    <div class="d-flex justify-content-between p-3">
                        <div class="media">
                            <img src="{{ $post->author->gravatar(50) }}" class="rounded-circle mr-3">
                            <div class="media-body">
                                <div>
                                    <strong>{{ $post->author->name }} @can('update', $post) (You) @endcan</strong>
                                </div>
                                {{ "@" . $post->author->username }}
                            </div>
                        </div>
                        @can('update', $post)
                        <small><a href="{{ url('posts/' . $post->slug . '/edit') }}" class="text-success">Edit</a></small>
                        @endcan
                    </div>
                    @if ($post->thumbnail)
                    <a href="{{ url('posts/' . $post->slug) }}">
                        <img src="{{ $post->takeImage }}" class="card-img-top" style="height: 300px; object-fit: cover; object-position: center;">
                    </a>
                    @endif
                    <div class="card-body {{ $post->thumbnail ? '' : 'pt-0'}}">
                        <h5 class="card-title mb-0"><a href="{{ url('posts/' . $post->slug) }}" class="text-dark">{{ $post->title }}</a></h5>
                        <small><a href="{{ url('categories/' . $post->category->slug) }}" class="text-secondary">{{$post->category->name}}</a></small> &middot; <small class="text-muted">Published on {{ $post->created_at->diffForHumans() }}</small>
                        <p class="card-text m-0 mt-2">{{ Str::limit($post->body , 160) }}</p>
                        <p class="card-text">
                            @foreach ($post->tags as $tag)
                            <small>
                                <a href="{{ url('tags/' . $tag->slug) }}">#{{ $tag->name }}</a>
                            </small>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {!! $posts->links() !!}
        </div>
        @if(!$posts)
        <p class="text-center">Post not found</p>
        @endif
    </div>

@endsection
