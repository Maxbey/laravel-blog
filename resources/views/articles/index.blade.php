@extends('layout')

@section('title', 'Blog')
@stop

@section('content')
    <h1>Posts</h1>
    <hr/>

    @if(!$articles->isEmpty())

        @foreach($articles as $article)
            <h2><a href="{{ action('ArticlesController@show', ['id' => $article->id]) }}">{{ $article->title }}</a></h2>
            <blockquote>
                <p>{{ $article->excerpt }}</p>
            </blockquote>
        @endforeach

    @else
        <h1>No data.</h1>

    @endif
@stop