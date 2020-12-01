<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - DriedSponge.net | Images</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/993187c8db.js" crossorigin="anonymous"></script>

    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@dried_sponge">
    <meta name="twitter:title" content="@yield('title')">

    <meta name="theme-color" content="#007BFF">

    <meta property="og:site_name" content="DriedSponge.net | Images"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:site_name" content="DriedSponge.net | Images"/>
    <meta property="og:title" content="@yield('title')"/>
    <link rel="icon" href="{{asset('favicon.png')}}">
    @yield('head')
</head>
<body>
    @yield('content')
</body>
</html>
