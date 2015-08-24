@extends('layout')

@section('title','Profile')
@stop

@section('content')
    <h1>{{ $user->login }}</h1>
    <hr/>
    <h4>Email: {{ $user->email }}</h4>
    <hr/>
    <h2>Your comments:</h2>

        @if(!$user->comments->isEmpty())
            <table class="table table-bordered">
                <tr>
                    <th>Article</th>
                    <th>Link</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @foreach($user->comments as $comment)
                <tr>
                    <td><a href="{{ action('ArticlesController@show', ['id' => $comment->article->id]) }}">{{ $comment->article->title }}</a></td>
                    <td><a href="{{ action('ArticlesController@show', ['id' => $comment->article->id]) . '#comment_' . $comment->id }}">{{ '#comment_' . $comment->id }}</a></td>
                    <td>{{ $comment->body }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td><a href="{{ action('CommentsController@edit', ['id' => $comment->id]) }}">Edit</a></td>
                    <td><a href="">Delete</a></td>
                </tr>
            @endforeach
            </table>
        @else
            <h3>You haven't left a comments</h3>
        @endif
@stop