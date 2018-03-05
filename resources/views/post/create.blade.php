@extends('layouts.master')

@section('content')
    @include('layouts.errors')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    {{--  <input type="text" class="form-control" id="content" name="content">  --}}
                    <textarea class="form-control" id="content" name="content" rows="10"></textarea>
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="col-md-3">
    </div>
@stop