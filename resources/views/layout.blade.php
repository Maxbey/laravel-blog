<!doctype html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
</head>
<body>
    <div class="container ">
        @include('flash.messages')

        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        $(function(){
            $('div.alert').delay(3000).fadeOut();
        });
    </script>
</body>
</html>