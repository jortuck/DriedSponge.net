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
    <script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>
    <meta id="captcha_site_key" name="captcha_site_key" content="{{config('extra.captcha_site_key')}}"/>
    <link rel="icon" href="{{asset('favicon.png')}}">
    <link rel="manifest" href="{{asset('manifest.json')}}">

</head>
<body>
<noscript>
    <h1 class="has-text-centered title page-title has-text-danger">YOU NEED TO ENABLE JAVASCRIPT TO MAKE THE SITE WORK</h1>
</noscript>
<div id="app">
    <app></app>
</div>

<script src="{{ mix('js/main.js') }}"></script>
</body>
</html>
