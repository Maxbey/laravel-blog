@extends('layout')

@section('title', 'Create new one user')
@stop

@section('content')

    <h2>Create a new one user</h2>
    <hr/>
    @include('errors.list')
    {!! Form::open(['method' => 'POST' , 'action' => ['UsersController@store']]) !!}
        @include('forms.user', ['submitButton' => 'Create User'])
    {!! Form::close() !!}

@stop