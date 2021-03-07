<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#007BFF">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/993187c8db.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{asset('favicon.png')}}">
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <!-- Cloudflare Web Analytics -->
    <script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "f9f0c4b4b8654a11a4fab5c4abdfa18c", "spa": true}'></script>
    <!-- End Cloudflare Web Analytics -->
</head>
<body>
<noscript>
    <h1 class="has-text-centered title page-title has-text-danger">YOU NEED TO ENABLE JAVASCRIPT TO MAKE THE SITE WORK</h1>
</noscript>
@if(session('error'))
    <div class="banner banner-danger">
        <b>{{session('error')}}</b>
    </div>
@endif
<div id="app">
    <app></app>
</div>

<script src="{{ mix('js/main.js') }}"></script>
</body>
</html>
