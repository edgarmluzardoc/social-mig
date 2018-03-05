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
        <table class='table table-bordered'>
            <tr>
                <th>Username</th>
                <th>{{ $post->title }}</th>
            </tr>
            <tr>
                <td colspan='2'>{{ $post->content }}<br>
                <div class=''>
                    <a href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
                    <a href="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
                </div>
                </td>
            </tr>
            <tr>
                <td class=''>Created: {{ $post->created_at }}</td>
                <td class=''>
                    <a href="#">X Comments</a>
                    <a href="#">X Likes</a>
                </td>
            </tr>
        </table>
    @endforeach
@stop