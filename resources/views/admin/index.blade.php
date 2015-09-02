@extends('layout')

@section('title', 'Admin Panel')
@stop

@section('content')
    <h1>Admin panel</h1>
    <hr/>
    <ul>
        <li><h4><a href="{{ action('AdminController@articlesControl') }}">Articles management</a></h4></li>
        <li><h4><a href="{{ action('AdminController@usersControl') }}">Users management</a></h4></li>
        <li><h4><a href="{{ action('AdminController@keysControl') }}">Invitation keys management</a></h4></li>
    </ul>

@stop