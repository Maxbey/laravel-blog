<!doctype html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"/>
<link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
</head>
<body>
    @include('main.navigation')
    <div class="container center-block">
        @include('flash.messages')

        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
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