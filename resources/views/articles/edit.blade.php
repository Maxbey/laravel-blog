@extends('layout')

@section('title', 'Edit ' . $article->title)
@stop

@section('content')
    <h1>Edit - {{ $article->title }}</h1>
    <hr/>
    @include('errors.list')

    {!! Form::model($article, ['method' => 'PATCH' , 'action' => ['ArticlesController@update', $article->id]]) !!}
        @include('forms.article', ['submitButton' => 'Update Article'])
    {!! Form::close() !!}
@stop