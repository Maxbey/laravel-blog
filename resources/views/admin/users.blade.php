@extends('layout')

@section('title', 'Users management')
@stop

@section('content')

    <h1>Users management</h1>
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
                    @if(!Auth::user()->isAdmin())
                        <td><a href="">Delete</a></td>
                    @else
                        <td></td>
                    @endif
                </tr>
                @endforeach
            </table>
        @else
            <h3>No registered users yet.</h3>
        @endif
@stop