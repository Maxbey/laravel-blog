@extends('layout')

@section('title', $article->title)
@stop

@section('content')
    <h1>{{ $article->title }}</h1>
    <hr/>
    <p>{{ $article->body }}</p>
    @if(!$tags->isEmpty())
        <h4>Tags:</h4>
        <ul>
            @foreach($tags as $tag)
                <li>{{ $tag }}</li>
            @endforeach
        </ul>
    @else
        <h4>This article doesn't have tags</h4>

    @endif
@stop