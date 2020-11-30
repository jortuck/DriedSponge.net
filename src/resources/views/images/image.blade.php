<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/993187c8db.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="section">
        <div class="container">
            @if($type == 'mp4')
                <video autoplay controls src="{{route('media.load-file',$uuid)}}"
            @else
                <img src="{{route('media.load-file',$uuid)}}">
            @endif
        </div>
    </section>
</body>
</html>
