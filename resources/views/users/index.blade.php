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
        </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>god</td>
                <td><a href="{{ action('UsersController@show', ['login' => $user->login]) }}">{{ $user->login }}</a></td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </table>
    @else
        <h3>No registered users yet.</h3>
    @endif

@stop