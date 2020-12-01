@extends('images.layout')
@section('title','Image or video not found!')
@section('head')
    <meta property="og:image" content="{{asset('/images/notfound.png')}}"/>
    <meta property="og:image:type" content="image/png"/>
    <meta property="twitter:image" content="{{asset('/images/notfound.png')}}"/>
@endsection
@section('content')
    <section class="section">
        <div class="container">
            <div class="has-text-centered mb-4">
                <h1 class="title page-title mb-1 has-text-danger">
                    Image not found!
                </h1>
                <h2 class="subtitle page-subtitle mt-2"></h2>
            </div>
        </div>
    </section>
@endsection
