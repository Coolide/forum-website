<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <!-- Link Bootstarp -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style>
        body { padding-bottom: 70px; }
    </style>
    <body>
        @if(!request()->routeIs('login'))
            <!-- Navigation Bar -->
            @include('layouts.nav')
        @endif

        <!-- Error messages -->
        @if($errors->any())
            <div class="container-fluid text-center alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Info messages -->
        @if(session('message'))
            <div class="container-fluid text-center alert alert-success">
                <p>{{session('message')}}</p>
            </div>
        @endif

        <!-- Page Content -->
        <div class="container">
            @yield('content')
        </div>
        @if(!request()->routeIs('login'))
            <!-- Footer -->
            @include('layouts.footer')
        @endif
    </body>
</html>
