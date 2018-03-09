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
                <table class="table no-border">
                    <tr>
                        <th class="center">Friends</th>
                    </tr>
                    <tr>
                        <td class="friends-row">
                            @if(count($friends) > 0)
                                @foreach($friends as $friend)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="friends[]" value="{{ $friend->id }}">{{ $friend->name }}
                                    </label>
                                </div>
                                @endforeach
                            @else
                                No friends found.
                            @endif
                        </td>
                    </tr>
                    <tr class="center">
                        <td><button type="submit" class="btn btn-primary">Remove</button></td>
                    </tr>
                </table>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-md-3">
            <form action="{{ route('friend.add') }}" method="post">
                <table class="table no-border">
                    <tr>
                        <th class="center">Users</th>
                    </tr>                    
                    <tr>
                        <td class="friends-row">
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="users[]" value="{{ $user->id }}">{{ $user->name }}
                                    </label>
                                </div>
                                @endforeach
                            @else
                                No users found.
                            @endif
                        </td>
                    </tr>
                    <tr class="center">
                        <td><button type="submit" class="btn btn-primary">Add</button></td>
                    </tr>
                </table>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@stop