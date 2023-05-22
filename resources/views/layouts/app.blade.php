<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <!-- CSRF Token -->
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>Ирбис</title>

    <!-- Preconnect to Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <!-- Load Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="//fonts.gstatic.com" rel="dns-prefetch">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Load Bootstrap -->
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" rel="stylesheet">
    <!-- Load Custom Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <div class="headbar py-1">
            <div class="container text-end">
                <a class="link-light text-decoration-none me-4" href="tel:+79999999999">8 (915) 218 8769</a>
                <a class="link-light text-decoration-none" href="tel:+79999999999">8 (915) 218 8769</a>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">

                <button aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}" class="navbar-toggler"
                    data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse justify-content-between navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <a class="navbar-brand col w-55" href="{{ url('/') }}">
                        <img alt="" class="mt-3 mt-md-0 img-fluid" height="90"
                            src="/public/img/logo_sidetext.svg" style="max-width: 65%;">
                    </a>
                    <ul class="navbar-nav mt-3 col mt-md-0">
                        <li class="navbar-item mx-1">
                            <a class="nav-link" href="/">Главная</a>
                        </li>
                        <li class="navbar-item mx-1">
                            <a class="nav-link" href="{{ route('catalog') }}">Каталог</a>
                        </li>
                        <li class="navbar-item mx-1">
                            <a class="nav-link" href="{{ route('contact') }}">Контакты</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav col justify-content-end">
                        <!-- Authentication Links -->
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="/cart">Корзина</a>
                        </li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item mx-1">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item mx-1">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown" href="#" id="navbarDropdown" role="button" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item " href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>

                                    <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                                        @csrf
                                    </form>
                                    @if (Auth::user()->admin)
                                        <a class="dropdown-item" href="/admin">Админка</a>
                                    @endif
                                    {{-- @can('admin', Auth::user())
                                        <a href="/admin" class="dropdown-item">Админка</a>
                                    @endcan --}}

                                </div>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="pt-4">
            @yield('content')
        </main>

    </div>
    <footer class="">
        @include('layouts.footer')
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>

</body>

</html>
