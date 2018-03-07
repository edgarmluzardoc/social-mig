@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>        
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
            <form action="{{ route('friend.remove') }}" method="post">
                <label for="title">Friends</label>
                @foreach($friends as $friend)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="friends[]" value="{{ $friend->id }}">{{ $friend->name }}
                        </label>
                    </div>
                @endforeach
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Remove</button>
            </form>
        </div>
        <div class="col-md-3">
            <form action="{{ route('friend.add') }}" method="post">
                <label for="title">Users</label>
                @foreach($users as $user)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="users[]" value="{{ $user->id }}">{{ $user->name }}
                        </label>
                    </div>
                @endforeach
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@stop