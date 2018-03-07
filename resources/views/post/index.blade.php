@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>        
    </div>
    @endif
    @foreach($posts as $post)
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="post-title">{{ $post->title }}</h1>
            <p class="post-content">{{ $post->content }}</p>
        </div>
        <div class="col-md-4 text-left">
            <a href="{{ route('comment.index', ['postId' => $post->id]) }}">{{ count($post->comments) }} Comments</a> | 
            <a href="#">{{ count($post->likes) }} Likes</a>
        </div>
        <div class="col-md-4 text-center">
            <p>{{ $post->created_at }} by {{ $post->user->name }}.</p>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('post.like', ['id' => $post->id]) }}">Like</a> | 
            <a href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a> | 
            <a href="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
        </div>
    </div>
    <hr>
    @endforeach

    <div class="col-md-12 text-center">
        {{ $posts->links() }}
    </div>
@stop