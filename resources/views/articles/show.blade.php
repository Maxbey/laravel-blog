@extends('layout')

@section('title', $article->title)
@stop

@section('content')
    <header>
         <h1>{{ $article->title }}</h1>
    </header>
    @if(!$tags->isEmpty())
            <ul class="list-inline">
                @foreach($tags as $slug => $tag)
                    <li><a href="{{ action('TagsController@articles', ['tagName' => $slug]) }}">#{{ $tag }}</a></li>
                @endforeach
            </ul>
        @else
            <p><b>This article doesn't have any tag</b><p>

        @endif

        @include('errors.list')
    <content>
       <div class="article col-md-10 center-block"><p>{!! $article->body !!}</p></div>
    </content>
    <div class="col-md-8">
       <div class="comments">
        <h3>Comments:</h3>
        @if(!$article->comments->isEmpty())
            @foreach($article->comments as $comment)
                <div class="comment" id="{{'comment_'. $comment->id }}">
                    <div class="comment-head">
                        <h4>{{ $comment->author }}
                         <small>{{ $comment->created_at->format('m-d-y') }} - {{ $comment->created_at->format('H-i-s') }}</small>
                        </h4>
                    </div>
                    <p>{!! $comment->body !!}</p>
                    @if(Auth::check())
                        @if($comment->byUser() && Auth::user()->id == $comment->user->id)
                            <a href="{{ action('CommentsController@edit', ['id' => $comment->id]) }}">Edit</a>
                        @endif
                    @endif
                </div>
            @endforeach
        @else
            <h4>No comments yet</h4>
        @endif

        </div>
    </div>
    <div class="col-md-8">
        <hr/>
                  <h3>Add a new Comment</h3>
                  {!! Form::open(['action' => ['CommentsController@store', $article->id], 'method' => 'POST']) !!}
                      @include ('forms.comment', ['submitButton' => 'Add Comment'])
                  {!! Form::close() !!}
              </div>
@stop