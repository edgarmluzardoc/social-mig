@extends('layouts.master')

@section('content')
    {{--  Error messages  --}}
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>        
        </div>
    @endif

    {{--  Post  --}}
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="post-title">{{ $post->title }}</h1>
            <p class="post-content">{{ $post->content }}</p>
        </div>
        <div class="col-md-4 text-left">
            <p>{{ count($post->comments) }} Comments | X Likes</p>
        </div>
        <div class="col-md-4 text-center">
            <p>{{ $post->created_at }} by Username.</p>
        </div>
        <div class="col-md-4 text-right">
            <a href="#">New Comment</a> | 
            <a href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a> | 
            <a href="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
        </div>
        <input type="hidden" name="id" value="{{ $post->id }}">
    </div>
    <hr>
    
    {{--  Comments --}}
    @foreach($comments as $comment)
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10 text-center">
                <p class="post-content">{{ $comment->content }}</p>
                <p>{{ $comment->created_at }} by Username.</p>
                <a href="#">Edit</a> | 
                <a href="#">Delete</a>
                <hr>
            </div>
            <div class="col-md-1">
            </div>
            <input type="hidden" name="commentId" value="{{ $comment->id }}">
        </div>
    @endforeach

    <div class="col-md-12 text-center">
        {{--  {{ $comments->links() }}  --}}
    </div>
@stop