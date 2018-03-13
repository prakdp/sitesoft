<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Сайтсофт') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="navbar">
        <div class="navbar-inner">
            <a class="brand" href="{{ url('/') }}">
                {{ config('app.name', 'Сайтсофт') }}
            </a>
            <ul class="nav">
                <li{{ (Request::is('/') ? ' class=active' : '') }}><a href="{{ url('/') }}">Главная</a></li>
                @guest
                    <li{{ (Request::is('login') ? ' class=active' : '') }}><a href="{{ route('login') }}">Авторизация</a></li>
                    <li{{ (Request::is('register') ? ' class=active' : '') }}><a href="{{ route('register') }}">Регистрация</a></li>
                @endguest
            </ul>

            @auth
            <ul class="nav pull-right">
                <li>
                    <a>{{ Auth::user()->name }}</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Выход
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            @endauth
        </div>
    </div>

    @yield('content')

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
