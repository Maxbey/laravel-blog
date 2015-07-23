@extends('layout')

@section('title', 'Blog')
@stop

@section('content')
    <h1>Posts</h1>
    <hr/>

    @if(!$articles->isEmpty())

        @foreach($articles as $article)
            <h1><a href="{{ action('ArticlesController@show', ['id' => $article->id]) }}">{{ $article->title }}</a></h1>
            <p>{{ $article->body }}</p>
            <hr/>
        @endforeach

    @else
        <h1>No data.</h1>

    @endif
@stop