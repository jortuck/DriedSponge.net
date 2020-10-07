@extends('layouts.app')
@section('title','403 - Unauthorized')
@section('description',"403 - Unauthorized")
@section("content")
    <div>
        <div class="container" id="landing-header">
            <div><h1  class="landing-h1 error center-align">4<span class="white-text">0</span>3</h1></div>
            <h2 class="landing-sub error center-align">{{ $exception->getMessage() }}</h2>
            <br>
            <div class="center-align errorlinks" >
                <p class="white-text"><a href="#" class="errorlink" onclick="window.history.back()">Go Back</a> | <a class="errorlink" href="{{route('pages.index')}}">Home</a></p>
            </div>
        </div>
    </div>
@endsection
