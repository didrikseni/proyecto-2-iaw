<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portal UNS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <!-- Icon library -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-sm fixed-top">
        <div class="nabvar-item nav-pills nabvar">
            <a href="{{ url('/') }}">
                <h1>Portal UNS</h1>
            </a>
        </div>

        <div class="navbar-items nav-pills navbar">
            <button>
                Nuevo articulo
            </button>
        </div>

        <div class="dropdown ml-auto">
            <a class="btn dropdown-toggle custom-text-navbar" data-toggle="dropdown"
                onmouseover="animateCSS(this, 'bounceIn')">
                Temas
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="setTheme('theme-light')">Claro</a>
                <a class="dropdown-item" onclick="setTheme('theme-dark')">Oscuro</a>
                <a class="dropdown-item" onclick="setTheme('theme-pastel')">Pastel</a>
                <a class="dropdown-item" onclick="setTheme('theme-warm')">Cálido</a>
            </div>
            <div>
                @if (Route::has('login'))
                <div class="ml-auto links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </>
                @endif
            </div>
    </nav>
    <!-- Nav Bar -->


    <!-- Footer -->
    <footer class="page-footer font-small blue pt-4 sticky-footer">
        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-6 mt-md-0">
                    <h5 class="text-uppercase custom-text-navbar">Primer Proyecto de Ingeniería de Aplicaciones Web
                    </h5>
                    <p class="custom-text-navbar">Universidad Nacional del Sur - Primer cuatrimestre 2020</p>
                </div>
                <div class="col-md-4 mb-md-0">
                    <h5 class="text-uppercase custom-text-navbar">Links de interes</h5>
                    <ul class="list-unstyled">
                        <li><a class="custom-text-navbar" href="https://es.wikipedia.org/wiki/Medici%C3%B3n">Historia de
                                la
                                Medición</a></li>
                        <li><a class="custom-text-navbar"
                                href="https://es.wikipedia.org/wiki/Sistema_de_unidades">Sistema
                                de Unidades</a></li>
                    </ul>
                </div>
                <div class="col-md-auto mb-md-0">
                    <h5 class="text-uppercase custom-text-navbar">Compartir</h5>
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
        <div class="footer-copyright text-center pb-2">
            <a class="custom-text-navbar" href="https://github.com/didrikseni/">Información del Autor</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

</body>

</html>
