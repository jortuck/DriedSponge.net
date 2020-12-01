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
    <meta property="og:site_name" content="DriedSponge.net | Images" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="theme-color" content="#007BFF">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:site_name" content="DriedSponge.net | Images" />
    <meta property="og:title" content="{{$name}}" />
    @if($type == 'mp4' or $type == 'mov' )
        <meta content="player" name="twitter:card">
        <meta property="og:video" content="{{route('media.load-file',$uuid)}}">
        <meta property="og:video:type" content="{{$mimeType}}">
        <meta content="{{$mimeType}}" name="twitter:player:stream:content_type">
        <meta content="{{$rawUrl}}" name="twitter:player">
        <meta content="{{$rawUrl}}" name="twitter:player:stream">
    @else
        <meta property="og:image" content="{{$rawUrl}}" />
        <meta property="og:image:type" content="{{$mimeType}}" />
    @endif
</head>
<body>
    <section class="section">
        <div class="container">
            @if($type == 'mp4' or $type == 'mov' )
                <video autoplay controls src="{{route('media.load-file',$uuid)}}"
            @else
                <img src="{{route('media.load-file',$uuid)}}">
            @endif
        </div>
    </section>
</body>
</html>
