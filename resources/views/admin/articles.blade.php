@extends('layout')

@section('title', 'Articles management')
@stop

@section('content')

    <h1>Articles management</h1>
    <hr/>

    <h4><a href="{{ action('ArticlesController@create') }}">Create a new one article</a></h4>

    @if(!$articles->isEmpty())
            <table class="table table-bordered">
            <tr>
                <th>id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Published at</th>
                <th>Deleted</th>
                <th>Edit</th>
                <th>Delete / Restore</th>
            </tr>
                @foreach($articles as $article)
                <tr {{ $article->deleted_at ? 'class=danger' : '' }} {{ !$article->isPublished() ? 'class=warning' : '' }}>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->user->login }}</td>
                    <td><a href="{{ action('ArticlesController@show', ['id' => $article->id]) }}">{{ $article->title }}</a></td>
                    <td>{{ $article->created_at }}</td>
                    <td>{{ $article->published_at }}</td>
                    <td>
                        @if($article->deleted_at) YES
                        @else NO
                        @endif
                    </td>
                    <td><a href="{{ action('ArticlesController@edit', ['id' => $article->id]) }}">Edit</a></td>
                    <td>
                        @if(!$article->deleted_at)
                            <a href="{{ action('ArticlesController@delete', ['id' => $article->id]) }}">Delete</a>
                        @else
                            <a href="{{ action('ArticlesController@restore', ['id' => $article->id]) }}">Restore</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        @else
            <h3>Articles doesn`t exists</h3>
        @endif
@stop