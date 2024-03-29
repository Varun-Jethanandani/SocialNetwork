<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{-- Highly useful for security --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    {{-- For using Ck editor commented div id="app" --}}
    {{-- <div id="app"> --}}
        {{-- @include('includes.navbar') --}}
        <main class="py-4">
            <div class="container">
                {{-- @include('includes.messages') --}}
                @yield('content')
            </div>
        </main>
        {{-- <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script> --}}
                <script>
                    // CKEDITOR.replace( 'article-ckeditor' );
        </script>
    {{-- </div> --}}
    
</body>
</html>
