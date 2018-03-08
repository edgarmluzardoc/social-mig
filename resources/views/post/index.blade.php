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
                <a href="#" title="{{ $post->likesUsers() }}">{{ count($post->likes) }} Likes</a>
            </div>
            <div class="col-md-4 text-center">
                <p>{{ ucwords($post->privacy) }} post. {{ $post->created_at }} by {{ $post->user->name }}.</p>
            </div>
            <div class="col-md-4 text-right">
                @guest
                    {{--  Cannot do actions if not logged in  --}}
                @else
                    {{--  Handling likes  --}}
                    @if($post->likes->contains('user_id', Auth::user()->id))
                        <a href="{{ route('post.unlike', ['postId' => $post->id]) }}">Unlike</a>
                    @else
                        <a href="{{ route('post.like', ['id' => $post->id]) }}">Like</a>
                    @endif

                    {{--  Handling Edit/Delete  --}}
                    @if($post->user_id == Auth::user()->id)
                        | <a href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
                        | <a href="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
                    @endif
                @endguest
            </div>
        </div>
        <hr>
    @endforeach

    <div class="col-md-12 text-center">
        {{--  TODO add pagination  --}}
        {{--  {{ $posts->links() }}  --}}
    </div>
@stop