@extends('layout')

@section('title', 'Users')
@stop

@section('content')
    <h1>Users registered in the application</h1>
    <hr/>
    @if(!$users->isEmpty())
        <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>Permissions</th>
            <th>Login</th>
            <th>Email</th>
            <th>Delete</th>
        </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->permission->group_name }}</td>
                <td><a href="{{ action('UsersController@show', ['login' => $user->login]) }}">{{ $user->login }}</a></td>
                <td>{{ $user->email }}</td>
                <td><a href="">Delete</a></td>
            </tr>
            @endforeach
        </table>
    @else
        <h3>No registered users yet.</h3>
    @endif

@stop