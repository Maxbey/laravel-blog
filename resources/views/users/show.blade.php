@extends('layout')

@section('title','User | ' . $user->login)
@stop

@section('content')
    <h1>{{ $user->login }}`s Profile</h1>
    <hr/>
    <h4>Permissions: {{ $user->isAdmin() ? 'Administrator' : 'User' }}</h4>
    <h4>Email: {{ $user->email }}</h4>

@stop