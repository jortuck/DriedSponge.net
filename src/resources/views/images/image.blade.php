@extends("images.layout")
@section('title',$name)
@section('head')
    @if(Str::contains($mimeType,'video'))
        <meta property="og:type" content="website">
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
@endsection
@section('content')
    <section class="section">
        <div class="container">
            @if(Str::contains($mimeType,'video'))
                <video autoplay controls src="{{route('media.load-file',$uuid)}}"></video>
            @else
                <img src="{{route('media.load-file',$uuid)}}">
            @endif
        </div>
    </section>
@endsection
