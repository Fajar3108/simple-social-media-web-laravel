@extends('layouts.app', ['title' => 'Add New Post'])

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h1 class="text-center mb-4">Add New Post</h1>
            <form action="{{ url('/posts/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('posts.partials.form-controll')
            </form>
        </div>
    </div>
</div>
@endsection
