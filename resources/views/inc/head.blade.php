<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link id='dark-theme-css' rel="stylesheet" href="@if(Cookie::get('theme') == 'dark') /css/dark.css @endif">
    <meta name="theme-color" content="#007BFF">
    <link href='https://fonts.googleapis.com/css?family=Bangers' rel='stylesheet'>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
    @yield('head')
</head>
