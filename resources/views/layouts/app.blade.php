<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title', config('app.name', 'Tarot Místico'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/venobox/venobox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/card-slider/css/style.css') }}">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
</head>

<body>

    <header class="navigation fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark">

            <a class="navbar-brand" href="{{ route('main') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="height: 50px; width: auto; margin-right: 10px;">
                {{ config('app.name', 'TarotApp') }}
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="navigation">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item {{ request()->routeIs('main') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('main') }}">Inicio</a>
                    </li>

                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('main') }}#seccion-temas">Hacer Pregunta</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('lectura.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('lectura.index') }}">Mis Lecturas</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('home') }}">Mi Perfil</a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        </nav>
    </header>

    @if(session('mensajeTexto') || session('status') || session('general') || $errors->any())
    <div class="container" style="padding-top: 120px; padding-bottom: 20px;">

        @if (session('mensajeTexto') || session('status') || session('general'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            <div class="d-flex align-items-center">
                <i class="ti-check-box mr-3" style="font-size: 1.2rem;"></i>
                <div>{{ session('mensajeTexto') ?? session('status') ?? session('general') }}</div>
            </div>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">
            <div class="d-flex align-items-start">
                <i class="ti-alert mr-3 mt-1" style="font-size: 1.2rem;"></i>
                <div>
                    <strong>Por favor, revisa lo siguiente:</strong>
                    <ul class="mb-0 pl-3 mt-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        @endif

    </div>
    @endif

    @yield('content')

    <footer class="bg-secondary position-relative mt-5">
        <div class="section py-5">
            <div class="container text-center">
                <h4 class="text-white mb-3">Tarot Místico</h4>
                <p class="text-light opacity-75">Descubre los misterios del universo a través de las cartas.</p>
                <p class="text-light mb-0 small opacity-50">Copyright &copy; {{ date('Y') }} Tarot Místico.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/plugins/jQuery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/card-slider/js/card-slider-min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>