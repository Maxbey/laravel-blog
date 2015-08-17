@extends('layout')

@section('title','Profile')
@stop

@section('content')
    <h1>Your Profile</h1>
    <hr/>
    <h4>Email: {{ $user->email }}</h4>

@stop