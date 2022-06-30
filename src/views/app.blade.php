<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>The Database</title>
        <link rel="stylesheet" href="{{ asset('thedatabase/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('thedatabase/simplelineicons/css/simple-line-icons.css') }}">
    </head>

    <body class="bg-dark text-light d-flex flex-column min-vh-100">
        
        
        <header>@include('thedatabase::navigation')</header>

        <content class="container bg-dark">
            <div class="p-2">@yield('header')</div>
            <div class="bg-dark rounded p-2">@yield('slot')</div>
        </content>

        <footer class="mt-auto px-4 border-top border-secondary">
            @yield('footer')
        </footer>
       
        <script src="{{ asset('thedatabase/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
        <script src="{{ asset('thedatabase/jquery/jquery.min.js') }}"></script>
        @include('thedatabase::toast')
    </body>
</html>
