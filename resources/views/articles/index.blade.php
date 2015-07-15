@extends('layout')

@section('title', 'Articles')
@stop

@section('content')

    @if(!$articles->isEmpty())

        @foreach($articles as $article)
            <h1><a href="{{ action('ArticlesController@show', ['id' => $article->id]) }}">{{ $article->title }}</a></h1>
            <hr/>
            <p>{{ $article->body }}</p>
        @endforeach

    @else
        <h1>No data.</h1>

    @endif
@stop