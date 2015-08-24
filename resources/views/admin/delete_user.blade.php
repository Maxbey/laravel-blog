@extends('layout')

@section('title', 'Delete user')
@stop

@section('content')

    <h2>Confirm the deletion {{ $user->login }} user</h2>
    <hr/>
    {!! Form::open(['method' => 'DELETE' , 'action' => ['UsersController@destroy', $user->id]]) !!}
    {!! Form::submit('Confirm', ['class' => 'btn btn-primary text-center']) !!}
    {!! Form::close() !!}

@stop