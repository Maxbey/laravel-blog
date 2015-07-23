@extends('layout')

@section('title', $article->title)
@stop

@section('content')
    <h1>{{ $article->title }}</h1>
    @if(!$tags->isEmpty())
            <ul class="tag-list list-inline">
                @foreach($tags as $tag)
                    <li><a href="{{ action('TagsController@articles', ['tagName' => $tag]) }}">#{{ $tag }}</a></li>
                @endforeach
            </ul>
        @else
            <p><b>This article doesn't have tags</b><p>

        @endif

        @include('errors.list')

    <hr/>
    <div class="post-body">
        <p>{{ $article->body }}</p>
    </div>
    <div class="col-md-8">
        <h4>Comments:</h4>
        @if(!$article->comments->isEmpty())
            @foreach($article->comments as $comment)
                <div class="comment" id="{{'comment_'. $comment->id }}">
                    <h4>{{ $comment->author }}</h4>
                    <blockquote>
                        <p>{{ $comment->body }}</p>
                    </blockquote>
                </div>

            @endforeach
        @else
            <h4>No comments yet</h4>
        @endif


    </div>
    <div class="col-md-8">
        <h4>Add a new Comment</h4>
        <hr/>
        {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}
            @include ('forms.comment', ['submitButton' => 'Add Comment'])
        {!! Form::close() !!}
    </div>
@stop