@extends('layout')

@section('title', $article->title)
@stop

@section('content')
    <header>
         <h1>{{ $article->title }}</h1>
    </header>
    @if(!$tags->isEmpty())
            <ul class="list-inline">
                @foreach($tags as $tag)
                    <li><a href="{{ action('TagsController@articles', ['tagName' => $tag]) }}">#{{ str_replace('_', ' ', $tag) }}</a></li>
                @endforeach
            </ul>
        @else
            <p><b>This article doesn't have tags</b><p>

        @endif

        @include('errors.list')
    <content>
       <div class="article col-md-10 center-block"><p>{{ $article->body }}</p></div>
    </content>
    <div class="col-md-8">
       <div class="comments">
        <h3>Comments:</h3>
        @if(!$article->comments->isEmpty())
            @foreach($article->comments as $comment)
                <div class="comment" id="{{'comment_'. $comment->id }}">
                    <h4><a href="">{{ $comment->author }}</a></h4>
                        <p>{{ $comment->body }}</p>
                </div>
            @endforeach
        @else
            <h4>No comments yet</h4>
        @endif

        </div>
    </div>
    <div class="col-md-8">
        <h3>Add a new Comment</h3>
        <hr/>
        {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}
            @include ('forms.comment', ['submitButton' => 'Add Comment'])
        {!! Form::close() !!}
    </div>
@stop