@extends('layouts.app')
@section('title','Home')
@section('description',"DriedSponge's Portfolio - Find out info about me and the stuff I make. It's epic guys.")
@section('content')
    <div>
        <div class="container" style="margin-top: 351px;">
            <h1 class="landing-h1">Dried <span class="white-text">Sponge</span></h1>
            <h2 class="landing-sub">Full Stack Web Developer</h2>
        </div>
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
