@extends('layout')

@section('title', 'Articles management')
@stop

@section('content')

    <h1>Articles management</h1>
    <hr/>

    <h4><a href="{{ action('ArticlesController@create') }}">Create a new one article</a></h4>

    @if(!$articles->isEmpty())
            <table class="table table-bordered admin-control-table" data-token="{{ csrf_token() }}">

                <tr>
                    <th>id</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Created at</th>
                    <th>Published at</th>
                    <th>Edit</th>
                    <th>Delete / Restore</th>
                </tr>

                <script id="article-row-template" type="text/x-handlebars-template">
                    @{{#each this}}

                    <tr class="@{{rowStyle}} article-row" data-id="@{{id}}" data-title="@{{title}}">

                        <td class="id">@{{id}}</td>
                        <td>@{{author}}</td>
                        <td><a href="@{{urls.showUrl}}">@{{title}}</a></td>
                        <td>@{{created_at}}</td>
                        <td>@{{published_at}}</td>
                        <td><a href="@{{urls.editUrl}}">Edit</a></td>
                        <td>
                            @{{#if deleted}}
                                <a href="" class="restore-link">Restore</a>

                            @{{else}}
                                <a href="" class="delete-link">Delete</a>
                            @{{/if}}
                        </td>
                    </tr>
                    @{{/each}}

                </script>
            </table>
    @else
        <h3>Articles doesn`t exists</h3>
    @endif

@stop

@section('js')

    <script>
        $(function(){
            var controller = new ArticlesPageController();
            controller.boot();
        });

    </script>
@stop