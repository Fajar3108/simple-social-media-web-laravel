<div class="input-group mb-3">
    <div class="custom-file">
        <input class="custom-file-input" type="file" name="thumbnail" id="thumbnail">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
    @error('thumbnail')
        <small class="invalid-feedback">* {{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="postTitle" class="form-label">Post Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="postTitle" name="title" value="{{ old('title') ?? $post->title }}">
    @error('title')
        <small class="invalid-feedback">* {{ $message }}</small>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
        <option disabled selected>Choose Category</option>
        @foreach ($categories as $category)
        <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}" >{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category')
        <small class="invalid-feedback">* {{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="tags" class="form-label">Tags</label>
    <select class="form-control select2 @error('tags') is-invalid @enderror" multiple="multiple" id="tags" name="tags[]">
        @foreach ($post->tags as $tag)
        <option selected value="{{ $tag->id }}" >{{ $tag->name }}</option>
        @endforeach
        @foreach ($tags as $tag)
        <option value="{{ $tag->id }}" >{{ $tag->name }}</option>
        @endforeach
    </select>
    @error('tags')
        <small class="invalid-feedback">* {{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="descText" class="form-label">Content</label>
    <textarea class="form-control @error('body') is-invalid @enderror" id="descText" rows="3" name="body">{{ old('body') ?? $post->body }}</textarea>
    @error('body')
        <small class="invalid-feedback">* {{ $message }}</small>
    @enderror
</div>
<button type="submit" class="btn btn-primary">
    {{ request()->is('posts/create') ? 'Create' : 'Update' }}
</button>
