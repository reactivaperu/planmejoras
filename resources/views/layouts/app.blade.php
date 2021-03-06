<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dev.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{url('/img/logo_institucion.png')}}" alt="Logo Institución" class="img-fluid" width="120">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="{{Request::is('planes')?'active':''}} nav-item">
                            <a class="nav-link" href="{{ url('planes') }}">{{ __('Planes de Mejora') }}</a>
                        </li>
                        @if(Auth::user()->tipo !== 'Invitado')
                        <li class="{{Request::is('acciones/asignado')?'active':''}} nav-item">
                            <a class="nav-link" href="{{ url('acciones/asignado') }}">{{ __('Acciones Asignadas') }}</a>
                        </li>
                        @endif
                        <li class="{{Request::is('usuarios/search')?'active':''}} nav-item">
                            <a class="nav-link" href="{{ url('usuarios/search?texto=&criterio=users.name') }}">{{ __('Busqueda') }}</a>
                        </li>
                        <li class="{{Request::is('reportes')?'active':''}} nav-item">
                            <a class="nav-link" href="{{ url('reportes') }}">{{ __('Reportes') }}</a>
                        </li>
                        @if(Auth::user()->tipo === 'Administrador')
                        <li class="{{Request::is('usuarios')?'active':''}} nav-item">
                            <a class="nav-link" href="{{ url('usuarios') }}">{{ __('Usuarios') }}</a>
                        </li>
                        @endif
                        <li class="{{Request::is('roles')?'active':''}} nav-item" hidden>
                            <a class="nav-link" href="{{ url('roles') }}">{{ __('Roles') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            @yield('content')
        </main>
    </div>
</body>
</html>
