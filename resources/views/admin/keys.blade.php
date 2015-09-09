@extends('layout')

@section('title', 'Create invation key')
@stop

@section('content')
    <h2>Invitation keys management</h2>
    <hr>
    <div class="col-md-6">
        <h4><a href="" class="create-link">Create key</a></h4>

        @if(count($keys))
            <table class="table table-bordered">
                <tr>
                    <th>Key</th>
                    <th>Delete</th>
                </tr>

                <script id="keys-table-template" type="text/x-handlebars-template">
                    @{{#each this}}

                    <tr class="key-row" data-id="">

                        <td>@{{this}}</td>
                        <td><a href="" class="delete-link">Delete</a></td>
                    </tr>
                    @{{/each}}

                </script>
            </table>
        @else
            <h3>Currently there are no invitation keys</h3>
        @endif
    </div>

@stop

@section('js')

    <script>
        $(function () {
            var controller = new KeysPageController();
            controller.boot();
        });

    </script>
@stop