<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
<header>
    <div class="hesita-top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pull-right">
                    <a href="https://www.facebook.com" class="f-link">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com" class="f-link">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>


            </div>
        </div>
    </div>
</header>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="menu-img" alt="" src="{{ asset('/images/kuchar.png') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('recipes')}}">{{__('Recepty') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route(('video_recipes'))}}">{{__('Video-recepty') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route(('categories'))}}">{{__('Kategórie') }}</a>
                    </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('recipe.create')}}">{{__('Pridať recept') }}</a>
                        </li>
                    @endauth
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.index') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('user.my_recipes') }}">Moje recepty</a>
                                @can('view', App\Models\User::class)
                                    <a class="dropdown-item" href="{{route('user.recipes_admin')}}">Spravovať recepty</a>
                                    <a class="dropdown-item" href="{{route('user.users_admin')}}">Spravovať používateľov</a>
                                    <a class="dropdown-item" href="{{route('category.index')}}">Spravovať kategórie</a>

                                @endcan
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


<footer>
    <div class="social">
        <a href="https://www.instagram.com"><i class="bi bi-instagram"></i></a>
        <a href="https://www.facebook.com"><i class="bi bi-facebook"></i></a>
    </div>
    <ul class="list">
        <li>
            <a href="{{route('root')}}">Domov</a>
        </li>
        @guest
            <li>
                <a href="{{route('login')}}">Prihlásenie</a>
            </li>
        @else
            <li>
                <a href="{{route('user.index')}}">Profil</a>
            </li>
        @endguest
        <li>
            <a href="{{route('about')}}">O nás</a>
        </li>
        <li>
            <a href="{{route('rules')}}">Pravidlá</a>
        </li>
        <li>
            <a href="{{route('privacy')}}">Súkromie</a>
        </li>
        <li>
            <a href="{{route('contact')}}">Kontakt</a>
        </li>
    </ul>
    <p class="copyright">Recepty pre každého @ 2023</p>
</footer>

</body>
</html>
