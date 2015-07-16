@extends('layout')

@section('title', $article->title)
@stop

@section('content')
    <h1>{{ $article->title }}</h1>
    <hr/>
    <p>{{ $article->body }}</p>
@stop