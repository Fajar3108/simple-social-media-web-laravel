@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $post->slug }}</li>
            </ol>
        </nav>
        <div class="row">
            @if ($post->thumbnail)
            <div class="col-md-6 mb-3">
                <img src="{{ $post->takeImage }}" class="rounded" style="width: 100%">
            </div>
            @endif
            <div class="col-md-6">
                <h1>{{ $post->title }}</h1>
                <small class="text-secondary">
                    <a href="{{ url('/categories/' . $post->category->slug) }}">{{ $post->category->name }}</a> &middot; {{ $post->created_at->format('d F Y') }}
                </small>
                <div class="media my-3">
                    <img src="{{ $post->author->gravatar(50) }}" class="rounded-circle mr-3">
                    <div class="media-body">
                        <div>
                            <strong>{{ $post->author->name }}</strong>
                        </div>
                        {{ "@" . $post->author->username }}
                    </div>
                </div>
                <p>{!! nl2br($post->body) !!}</p>
                <div class="text-secondary">
                    <p>Tags :
                    @foreach ($post->tags as $tag)
                        <a class="btn btn-link btn-sm" href="{{ url('/tags/' . $tag->slug) }}">#{{ $tag->name }}</a>
                    @endforeach
                    </p>
                </div>
                <div class="my-3">
                    <h6>Comments</h6>
                    <form action="{{ url('posts/'. $post->slug .'/comment') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Type your comment here" aria-label="Type your comment here" aria-describedby="addCommentButton" name="body">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit" id="addCommentButton">Send</button>
                            </div>
                        </div>
                        @error('body')
                            <small class="invalid-feedback">* {{ $message }}</small>
                        @enderror
                    </form>
                    @foreach ($post->comments as $comment)
                    <p class="mb-0">
                        <strong class="text-secondary">
                            {{ "@" . $comment->user->username }}
                        </strong>
                        {{ $comment->body }}
                    </p>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
