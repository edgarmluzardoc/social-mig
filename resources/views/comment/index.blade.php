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
            <p>{{ count($post->comments) }} Comments | 
                <a href="#" title="{{ $post->likesUsers() }}">{{ count($post->likes) }} Likes</a>
            </p>
        </div>
        <div class="col-md-4 text-center">
            <p>{{ ucwords($post->privacy) }} post. {{ $post->created_at }} by {{ $post->user->name }}.</p>
        </div>
        <div class="col-md-4 text-right">
            @guest
                {{--  Cannot do actions if not logged in  --}}
            @else
                <a href="#" data-toggle="modal" data-target="#createCommentModal">Comment</a>

                {{--  Handling likes  --}}
                @if($post->likes->contains('user_id', Auth::user()->id))
                    | <a href="{{ route('post.unlike', ['postId' => $post->id]) }}">Unlike</a>
                @else
                    | <a href="{{ route('post.like', ['id' => $post->id]) }}">Like</a>
                @endif
                {{--  <a href="{{ route('post.like', ['id' => $post->id]) }}">Like</a> |   --}}

                {{--  Handling Edit/Delete  --}}
                @if($post->user_id == Auth::user()->id)
                    | <a href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
                    | <a href="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
                @endif
            @endguest
        </div>
        <input type="hidden" name="id" value="{{ $post->id }}">
    </div>
    <hr>

    {{--  Modal Create Comment  --}}
    @include('comment.create')

    {{--  Comments --}}
    @foreach($comments as $comment)
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10 text-center">
                <p class="post-content">{{ $comment->content }}</p>
                <p>{{ $comment->created_at }} by {{ $comment->user->name }}.</p>
                @guest
                    {{--  Cannot do actions if not logged in  --}}
                @else
                    {{--  Handling Edit/Delete  --}}
                    @if($comment->user_id == Auth::user()->id)
                        <a href="#" data-toggle="modal" data-target="#editCommentModal{{ $comment->id }}">Edit</a> | 
                        <a href="{{ route('comment.delete', ['commentId' => $comment->id]) }}">Delete</a>
                    @endif
                @endguest
                <hr>
            </div>
            <div class="col-md-1">
            </div>
            <input type="hidden" name="commentId" value="{{ $comment->id }}">
        </div>
        {{--  Modal Edit Comment  --}}
        @include('comment.edit')
    @endforeach
@stop