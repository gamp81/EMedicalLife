<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- Favicon -->
        <link rel="shortcut icon" href="images/gmiti.ico">
        <title>GMITI Soluciones Informaticas</title>
        <meta name="language" content="spanish">
        <meta name="copyright" content="GMITI">
        <meta name="author" content="Moncada G">
        <meta name="audience" content="all">
        <meta name="description" content="Soluciones informaticas, sistema de facturacion , sistema de laboratorios clinicos">
        <meta name="robots" content="index,all,follow">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        
        <link rel="stylesheet" href="/css/style.css">
        @yield('estilos')
       <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-gray-800 py-6">
           
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        <i class="fas fa-shield icon-lg" style="color:white; font-size: 50px;" >GMITI</i>
                        Services
                        {{-- {{ config('app.name', 'GMITI') }} Services --}}
                    </a>
                </div>
                <nav class="space-x-4 text-gray-300 text-lg text-2xl">
                    <a class="no-underline hover:underline" href="/">Inicio</a>
                    <a class="no-underline hover:underline" href="/servicios">Servicios</a>
                    <a class="no-underline hover:underline" href="/productos">Productos</a>
                    <a class="no-underline hover:underline" href="/about">Nosotros</a>
                    <a class="no-underline hover:underline" href="/post">Blog</a>
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        <!-- @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif -->
                    @else
                        <a class="no-underline hover:underline" href="/favorites">Favorites</a>


                        <span>{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        <div>
            @yield('content')
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
  
</body>
</html>
