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
            <table class="table table-bordered" data-token="{{ csrf_token() }}">
                <tr>
                    <th>Article</th>
                    <th>Link</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <script id="comments-table-template" type="text/x-handlebars-template">

                    @{{#each this}}

                    <tr data-id="@{{id}}">

                        <td><a href="@{{urls.articleUrl}}">@{{articleTitle}}</a></td>
                        <td><a href="@{{urls.commentUrl}}">#</a></td>
                        <td>@{{body}}</td>
                        <td>@{{created_at}}</td>
                        <td><a href="@{{urls.editUrl}}">Edit</a></td>
                        <td><a href="" class="delete-link">Delete</a></td>
                    </tr>

                    @{{/each}}

                </script>
            </table>
        @else
            <h3>You haven't left a comments</h3>
        @endif
@stop

@section('js')
    <script>

        $(function(){
            var controller = new ProfilePageController();
            controller.boot();
        });

    </script>
@stop