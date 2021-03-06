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
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav mr-auto">
                        @if(Auth::user()->hasPermission("system.menu.view"))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    System Admin <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  @if(Auth::user()->hasPermission("roles.manage"))<a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>@endif
                                  @if(Auth::user()->hasPermission("departments.manage"))<a class="dropdown-item" href="{{ route('departments.index') }}">Departments</a>@endif
                                  @if(Auth::user()->hasPermission("divisions.manage"))<a class="dropdown-item" href="{{ route('divisions.index') }}">Divisions</a>@endif
                                  @if(Auth::user()->hasPermission("certs.manage"))<a class="dropdown-item" href="{{ route('certifications.index') }}">Certifications</a>@endif
                                  <!-- <a class="dropdown-item" href="#"></a> -->
                                </div>
                            </li>
                        @endif

                        @if(Auth::user()->hasPermission("structure.menu.view"))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Structure Admin <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  @if(Auth::user()->hasPermission("types.manage"))<a class="dropdown-item" href="{{ route('types.index') }}">Unit Types</a>@endif
                                  @if(Auth::user()->hasPermission("plans.manage"))<a class="dropdown-item" href="{{ route('plans.index') }}">Response Plans</a>@endif
                                  @if(Auth::user()->hasPermission("stations.manage"))<a class="dropdown-item" href="{{ route('stations.index') }}">Fire Stations</a>@endif
                                </div>
                            </li>
                        @endif

                        @if(Auth::user()->hasPermission("map.menu.view"))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Map Admin <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  @if(Auth::user()->hasPermission("streets.manage"))<a class="dropdown-item" href="{{ route('streets.index') }}">Streets</a>@endif
                                  @if(Auth::user()->hasPermission("postals.manage"))<a class="dropdown-item" href="{{ route('postals.index') }}">Postals</a>@endif
                                  @if(Auth::user()->hasPermission("subpostals.manage"))<a class="dropdown-item" href="{{ route('subpostals.index') }}">Subpostals</a>@endif
                                  @if(Auth::user()->hasPermission("trailmarkers.manage"))<a class="dropdown-item" href="{{ route('trailmarkers.index') }}">Trailmarkers</a>@endif
                                  @if(Auth::user()->hasPermission("grids.manage"))<a class="dropdown-item" href="{{ route('grids.index') }}">Grids</a>@endif
                                </div>
                            </li>
                        @endif
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('account.settings') }}">Account Settings</a>
                                    <a class="dropdown-item" href="{{ route('account.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('account.logout') }}" method="POST" style="display: none;">
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
            <div class="card">
                <div class="card-header">@yield('title')</div>

                <div class="card-body">
                    @if (session('msg.text'))
                        <div class="alert alert-{{ session('msg.type') }}" role="alert">
                            {{ session('msg.text') }}
                        </div>
                    @endif

                    @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif


                      @yield('content')
                </div>
            </div>
          </div>
      </main>

      </div>

    @yield('scripts')
</body>
</html>
