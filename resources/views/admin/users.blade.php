@extends('layout')

@section('title', 'Users management')
@stop

@section('content')

    <h1>Users management</h1>
    <hr/>

    <h4><a href="{{ action('UsersController@create') }}">Create a new one user</a></h4>
    <h4><a href="#">Create invitation key</a></h4>

        @if(!$users->isEmpty())
            <table class="table table-bordered">
            <tr>
                <th>id</th>
                <th>Permissions</th>
                <th>Login</th>
                <th>Email</th>
                <th>Registration date</th>
                <th>Delete / Restore</th>
            </tr>
                @foreach($users as $user)
                    <tr {{ $user->deleted_at ? 'class=danger' : '' }}>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->permission->group_name }}</td>
                        <td><a href="#">{{ $user->login }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        @if(Auth::user()->id != $user->id)

                            <td>
                                @if(!$user->deleted_at)
                                    <a href="">Delete</a>
                                @else
                                    <a href="">Restore</a>
                                @endif
                            </td>
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