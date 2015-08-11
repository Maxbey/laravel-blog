<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Laravel Blog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ action('PagesController@index') }}">Home</a></li>
            <li><a href="{{ action('ArticlesController@index') }}">Blog</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">

            @if(Auth::check())

                <li>
                    <a href="{{ action('UsersController@show', ['login' => Auth::user()->login]) }}">
                        {{ Auth::user()->login }}
                    </a>
                </li>

                @if(Auth::user()->isAdmin())

                    <li>
                        <a href="{{ action('AdminController@index') }}">Admin Panel</a>
                    </li>

                @endif

                <li>
                    <a href="{{ action('Auth\AuthController@getLogout') }}">Sign out</a>
                </li>

            @else

                <li>
                    <a href="{{ action('Auth\AuthController@getLogin') }}">Sign in</a>
                </li>

            @endif

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>