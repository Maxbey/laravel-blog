@extends('layout')

@section('title', 'Create new article')
@stop

@section('content')
    <h1>Create new article</h1>
    <hr/>
    @include('errors.list')

    <div class="col-md-10">
        {!! Form::model($article, ['action' => 'ArticlesController@store']) !!}
            @include('forms.article', ['submitButton' => 'Add Article'])
        {!! Form::close() !!}
    </div>

@stop
