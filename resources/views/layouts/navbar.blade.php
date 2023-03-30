<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bank Syariah Indonesia</title>

    <!-- Scripts -->

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

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light stroke shadow-sm" style="background-color: #00a39d;">
            <div class="container">
                <a class="navbar-brand navbar-logo" href="{{ url('/harian') }}">
                    <img src="https://bsimobile.co.id/wp-content/uploads/2019/09/BSI_Horizontal-Logo_Multiple_Background_07012021-1.png" alt="Logo" width="150">
                </a>

                
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    


    
                        
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