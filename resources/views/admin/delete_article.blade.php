@extends('layout')

@section('title', 'Delete article')
@stop

@section('content')

    <h2>Confirm the deletion <a href="{{ action('ArticlesController@show', ['id' => $article->id]) }}">{{ $article->title }}</a> article</h2>
    <hr/>
    {!! Form::open(['method' => 'DELETE' , 'action' => ['ArticlesController@destroy', $article->id]]) !!}
        {!! Form::submit('Confirm', ['class' => 'btn btn-primary text-center']) !!}
    {!! Form::close() !!}

@stop