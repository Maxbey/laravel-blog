@extends('layout')

@section('title', 'Home')
@stop

@section('content')
    <h1>Laravel blog</h1>
    <div class="row">
        <div class="col-md-9">
            <h2>Latest articles</h2>
            <hr>
            @if(!$articles->isEmpty())

                @foreach($articles as $article)
                    <h3>
                        <a href="{{ action('ArticlesController@show', ['id' => $article->id]) }}">{{ $article->title }}</a>
                        <small>Published: {{ $article->created_at->format('D M Y') }}</small>
                    </h3>
                @endforeach

            @else
                <h2>No data</h2>
            @endif
        </div>
        <div class="col-md-3">
            <h2>Latest comments</h2>
            <hr>
            @if(!$comments->isEmpty())

                @foreach($comments as $comment)
                    <div class="latest-comment">
                        <h4><a href="{{ action('ArticlesController@show', ['id' => $comment->article->id]) . '#comment_' . $comment->id }}">{{ $comment->author }}: <small>{{ $comment->article->title }}</small></a></h4>
                        <p>{{ $comment->body }}</p>
                    </div>
                @endforeach

            @else
                <h2>No data</h2>
            @endif
        </div>
    </div>
@stop
