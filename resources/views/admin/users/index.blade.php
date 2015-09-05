@extends('layout')

@section('title', 'Users management')
@stop

@section('content')

    <h1>Users management</h1>
    <hr/>

    <h4><a href="{{ action('UsersController@create') }}">Create a new one user</a></h4>

        @if(!$users->isEmpty())
            <table class="table table-bordered">
            <tr>
                <th>id</th>
                <th>Permissions</th>
                <th>Login</th>
                <th>Email</th>
                <th>Registration date</th>
                <th>Delete / Restore</th>
            </tr>

                <script id="users-table-template" type="text/x-handlebars-template">

                    @{{#each this}}

                    <tr class="@{{rowStyle}} user-row" data-id="@{{id}}">

                        <td class="id">@{{id}}</td>
                        <td>@{{permissions}}</td>
                        <td>@{{login}}</td>
                        <td>@{{email}}</td>
                        <td>@{{created_at}}</td>
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
        @else
            <h3>No registered users yet.</h3>
        @endif
@stop

@section('js')
    <script>

        $(function(){
            var controller = new UsersPageController();
            controller.boot();
        });

    </script>
@stop