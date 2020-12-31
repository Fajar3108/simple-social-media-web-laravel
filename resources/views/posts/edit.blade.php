@extends('layouts.app', ['title' => 'Update Post'])

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h1 class="text-center mb-4">Edit Your Post</h1>
            <form action="{{ url('/posts/' . $post->slug . '/update') }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                @include('posts.partials.form-controll')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Are you sure ?</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <p class="my-0">Post Title : </p>
        <h4>{{ $post->title }}</h4>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link text-danger" data-bs-dismiss="modal">Cancel</button>

        <form action="{{ url('posts/'. $post->slug .'/delete') }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete Post</button>
        </form>
    </div>
    </div>
</div>
</div>
@endsection
