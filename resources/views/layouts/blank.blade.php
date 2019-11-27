<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | @yield('section') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                      @if(Auth::user()->hasSection("Administration"))
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Administration <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->hasPermission("departments.manage"))<a class="dropdown-item" href="{{ route('departments.index') }}">Departments</a>@endif
                                @if(Auth::user()->hasPermission("certifications.manage"))<a class="dropdown-item" href="{{ route('certifications.index') }}">Certifications</a>@endif
                                @if(Auth::user()->hasPermission("divisions.manage"))<a class="dropdown-item" href="{{ route('divisions.index') }}">Divisions</a>@endif
                                @if(Auth::user()->hasPermission("roles.manage"))<a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>@endif
                                @if(Auth::user()->hasPermission("users.manage"))<a class="dropdown-item" href="{{ route('users.index') }}">Users</a>@endif
                                @if(Auth::user()->hasPermission("requests.manage"))<a class="dropdown-item" href="{{ route('requests.index') }}">Access Requests</a>@endif
                                @if(Auth::user()->hasPermission("units.manage"))<a class="dropdown-item" href="{{ route('apparatus.index') }}">Apparatus</a>@endif
                                @if(Auth::user()->hasPermission("stations.manage"))<a class="dropdown-item" href="{{ route('stations.index') }}">Stations</a>@endif
                                @if(Auth::user()->hasPermission("plans.manage"))<a class="dropdown-item" href="{{ route('plans.index') }}">Plans</a>@endif
                                @if(Auth::user()->hasPermission("postals.manage"))<a class="dropdown-item" href="{{ route('postals.index') }}">Postals</a>@endif
                            </div>
                        </li>
                      </ul>
                      @endif
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
          <div class="container">
              @yield('content')
          </div>
        </main>

      </div>

    @yield('scripts')
</body>
</html>
