@extends('layouts.app')
@section('title','Under Construction')
@section('description',"Under Construction")
@section("content")
    <div>
        <div class="container" id="landing-header">
            <div><h1  class="landing-h1 center-align">Under <span class="white-text">Construction</span></h1></div>
            <h2 class="landing-sub error center-align">This page is under construction, please check back later.</h2>
            <br>
            <div class="center-align errorlinks" >
                <p class="white-text"><a href="#" class="errorlink" onclick="window.history.back()">Go Back</a> | <a class="errorlink" href="{{route('pages.index')}}">Home</a></p>
            </div>
        </div>
    </div>
@endsection
