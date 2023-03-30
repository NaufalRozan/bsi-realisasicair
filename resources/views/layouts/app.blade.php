<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bank Syariah Indonesia</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            padding-top: 70px;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
        }
    </style>
</head>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light stroke shadow-sm" style="background-color: #00a39d;">
            <div class="container">
                <a class="navbar-brand navbar-logo" href="{{ url('/harian') }}">
                    <img src="https://bsimobile.co.id/wp-content/uploads/2019/09/BSI_Horizontal-Logo_Multiple_Background_07012021-1.png" alt="Logo" width="150">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto ">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" style="color: white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                CBRM
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="/harian">Input Data</a>
                                <a href="/data">Data CBRM</a>
                                <div class="dropdown-divider"></div>
                                <a href="/grafik">Grafik CBRM</a>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" style="color: white;" aria-current="page" href="/marketing">Marketing</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" style="color: white;" aria-current="page" href="/keseluruhan">Keseluruhan</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" style="color: white;" aria-current="page" href="/podium">Podium</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class=" navbar-nav ms-auto">
                        <!-- Authentication Links -->


                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="{{ route('register') }}">{{ __('Tambah Marketing') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" style="color: white;" href="/cabang">{{ __('Tambah Outlet') }}</a>
                        </li>

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