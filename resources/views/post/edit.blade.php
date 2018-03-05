@extends('layouts.master')

@section('content')
    @include('layouts.errors')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form action="{{ route('post.update') }}" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10">{{ $post->content }}</textarea>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $postId }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@stop