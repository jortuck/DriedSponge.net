<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$name}} - DriedSponge.net | Images</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/993187c8db.js" crossorigin="anonymous"></script>

    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@dried_sponge">
    <meta name="twitter:title" content="{{$name}}">

    <meta name="theme-color" content="#007BFF">

    <meta property="og:site_name" content="DriedSponge.net | Images"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:site_name" content="DriedSponge.net | Images"/>
    <meta property="og:title" content="{{$name}}"/>
    <link rel="icon" href="{{asset('favicon.png')}}">
    @if($type == 'mp4' or $type == 'mov' )
        <meta property="og:type" content="video">
        <meta property="og:video" content="{{route('media.load-file',$uuid)}}">
        <meta property="og:video:type" content="{{$mimeType}}">

        {{-- Twitter: --}}
        <meta name="twitter:card" content="player">
        <meta name="twitter:player:stream:content_type" content="{{$mimeType}}">
        <meta name="twitter:player" content="{{$rawUrl}}">
        <meta name="twitter:player:stream" content="{{$rawUrl}}">
        <meta name="twitter:player:height" content="480">
        <meta name="twitter:text:player_width" content="480">
        <meta name="twitter:player:width" content="480">

    @else
        <meta property="og:image" content="{{$rawUrl}}"/>
        <meta property="og:image:type" content="{{$mimeType}}"/>

        <meta property="twitter:image" content="{{$rawUrl}}"/>
    @endif
</head>
<body>
<section class="section">
    <div class="container">
        @if($type == 'mp4' or $type == 'mov' )
            <video autoplay controls src="{{route('media.load-file',$uuid)}}"></video>
        @else
            <img src="{{route('media.load-file',$uuid)}}">
        @endif
    </div>
</section>
</body>
</html>
