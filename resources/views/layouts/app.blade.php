<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Portal UNS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/themes.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>

    <!-- Icon library -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    @yield('head')
</head>

<body class="d-flex flex-column">
<!-- Nav Bar -->
<nav class="navbar navbar-expand-sm nav position-absolute fixed-top">
    <div class="nabvar-item nav-pills nabvar">
        @auth
            <a href="{{ url('/home') }}" class="custom-text-navbar faster navbar-brand" onmouseover="animateCSS(this, 'fadeIn')">
                <p>Portal UNS</p>
            </a>
        @else
            <a href="{{ url('/') }}" class="custom-text-navbar faster navbar-brand" onmouseover="animateCSS(this, 'fadeIn')">
                <p>Portal UNS</p>
            </a>
        @endauth
    </div>

    <div class="ml-auto">
        <ul class="navbar-nav nav-pills nav-justified">
            @if (Route::has('login'))
                <div class="ml-auto links">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link custom-text-navbar faster" href="{{ url('/articles/create') }}"
                               onmouseover="animateCSS(this, 'fadeIn')">
                                <i class="fas fa-cloud-upload-alt custom-text-navbar"></i>  Artículo
                            </a>
                        </li>
                        <li>
                            <div class="dropdown">
                                <a class="btn dropdown-toggle custom-text-navbar" data-toggle="dropdown"
                                   onmousedown="animateCSS(this, 'bounceIn')">
                                    {{ __(auth()->user()->name) }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm-right">
                                    <form method="GET" action="/profile" id="config-account">
                                        @csrf
                                        <button class="btn card-link dropdown-item"> Editar perfil </button>
                                    </form>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="/logout" id="logout-form">
                                        @csrf
                                        <button class="btn card-link dropdown-item"> Salir </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link custom-text-navbar faster" href="{{ url('/login') }}"
                               onmouseover="animateCSS(this, 'fadeIn')">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link custom-text-navbar faster" href="{{ route('register') }}"
                               onmouseover="animateCSS(this, 'fadeIn')">
                                Register
                            </a>
                        </li>
                    @endauth
                    @endif
                </div>
        </ul>
    </div>
    <div class="dropdown">
        <a class="fas fa-sliders-h btn dropdown-toggle custom-text-navbar" data-toggle="dropdown"
           onmousedown="animateCSS(this, 'bounceIn')">
        </a>
        <div class="dropdown-menu dropdown-menu-sm-right">
            <a class="dropdown-item" onclick="setTheme('theme-light')">Claro</a>
            <a class="dropdown-item" onclick="setTheme('theme-dark')">Oscuro</a>
            <a class="dropdown-item" onclick="setTheme('theme-pastel')">Pastel</a>
            <a class="dropdown-item" onclick="setTheme('theme-warm')">Cálido</a>
        </div>
    </div>
</nav>
<!-- Nav Bar -->

<br><br>
@yield('content')
<br><br>

<!-- Footer -->
<footer class="page-footer pt-4 sticky-footer">
    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">
        <!-- Grid row -->
        <div class="row">
            <!-- Grid column -->
            <div class="col-md-6 mt-md-0">
                <h5 class="custom-text-navbar">Ayudando a aprender</h5>
            </div>
            <div class="col-md-4 mb-md-0">
                <h5 class="custom-text-navbar">Preguntas frecuentes</h5>
                <ul class="list-unstyled">
                </ul>
                <h5 class="custom-text-navbar">Términos y condiciones</h5>
            </div>

            <div class="col-md-auto mb-md-0">
                <h5 class="custom-text-navbar">Compartir</h5>
                <ul class="list-unstyled">
                    <div class="btn">
                        <i class="fab fa-facebook-f fa-lg" onclick="
                        window.open(
                          'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),
                          'facebook-share-dialog',
                          'width=600,height=400');
                        return false;"></i>
                    </div>
                    <div class="btn">
                        <i class="fab fa-twitter p-3 fa-lg" onclick="
                        window.open(
                          'https://twitter.com/intent/tweet?url=' +encodeURIComponent(location.href),
                          'twitter-share-dialog',
                          'width=600,height=400');
                        return false;"></i>
                    </div>
                </ul>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>
    <!-- Footer Links -->
    <!-- Copyright -->
    <div class="container-fluid footer-copyright text-center pb-2">
        <div class="row justify-content-center">
            <div class="col-auto">
                <p class="custom-text-navbar">Acerca del autor</p>
            </div>
            <div class="col-auto">
                <a href="https://github.com/didrikseni" class="faster" onmouseover="animateCSS(this, 'fadeIn')"><i class="fab fa-github"></i></a>
            </div>
            <div class="col-auto">
                <a href="https://www.linkedin.com/in/iandidriksen/" class="faster" onmouseover="animateCSS(this, 'fadeIn')"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

<script src="{{ asset('js/themeSetting.js') }}"></script>
<script src="{{ asset('js/animations.js') }}"></script>
@yield('scripts')
</body>
</html>
