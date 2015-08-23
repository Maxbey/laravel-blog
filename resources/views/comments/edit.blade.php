@extends('layout')

@section('title', 'Edit comment')
@stop

@section('content')
    <div class="col-md-8">
        <h3>Edit comment</h3>
        <hr/>
        {!! Form::model($comment, ['action' => ['CommentsController@update', $comment->id], 'method' => 'PATCH']) !!}
            @include ('forms.comment', ['submitButton' => 'Update Comment'])
        {!! Form::close() !!}
    </div>
@stop
