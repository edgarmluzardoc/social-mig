@extends('layouts.master')

@section('content')
    <table class='table'>
        <tr>
            <th>Username</th>
            <th>Post Title</th>
        </tr>
        <tr>
            <td colspan='2'>Post Message<br>
            <div class=''>
                <a href="#">Edit</a>
                <a href="#">Delete</a>
            </div>
            </td>
        </tr>
        <tr>
            <td class=''>Created:</td>
            <td class=''>
                <a href="#">X Comments</a>
                <a href="#">X Likes</a>
            </td>
        </tr>
    </table>
@stop