<!doctype html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
{!! Html::script('vendor/jquery/dist/jquery.min.js'); !!}
{!! Html::script('vendor/select2/dist/js/select2.min.js'); !!}
{!! Html::script('vendor/bootstrap/dist/js/bootstrap.min.js'); !!}

{!! Html::style('vendor/select2/dist/css/select2.min.css') !!}
{!! Html::style('vendor/bootstrap/dist/css/bootstrap.min.css') !!}

<link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
</head>
<body>
    @include('main.navigation')
    <div class="container center-block">
        @include('flash.messages')

        @yield('content')
    </div>
    <script>
        $(function(){
            $('div.alert').delay(2000).fadeOut();
            $('.select').select2({
                placeholder: "Select the tags",
                tags: true
            });
        });
    </script>
</body>
</html>