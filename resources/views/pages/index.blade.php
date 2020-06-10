@extends('layouts.app')
@section('title','Home')
@section('description',"DriedSponge's Portfolio - Find out info about me and the stuff I make. It's epic guys.")
@section('content')
    <div>
        <br>
        <div class="text-center">
            <h1 style="font-weight: 900; margin-bottom: 0">DriedSponge</h1>
            <h4 style="margin-top: 5px;font-weight: 900">Full Stack Web Developer</h4>
        </div>
        <br>
        <br>
        <div class="section" style="background-color:#2A5989; padding-bottom: 150px; padding-top:75px">
            <div class="container">
                <h1 class="center-align white-text">About Me</h1>
                <div class="row center-align">
                    <div class="col s12 m9" style="float: none !important;margin-left: auto; margin-right: auto">
                        <p class="center-align flow-text white-text">I am a developer who first started coding on gmod
                            making
                            addons. I then found
                            out that once you know one langauge, it's easier to exapand to others, so that's exactly
                            what I
                            did.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="section" style="z-index: 1000;position:relative; top: -200px">
            <div class="container">
                <div class="row">
                    <div class="col s12 m4">
                        <div class="card-panel hoverable" style="height: 350px">
                            <h5 class="center-align card-panel-header"><b>Backend Development</b></h5>
                            <p class="flow-text center-align">I have expierience with lots of backend development
                                including
                                laravel, python and node js.</p>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card-panel hoverable" style="height: 350px">
                            <h5 class="center-align card-panel-header"><b>Server Infrastructure</b></h5>
                            <p class="flow-text center-align">Web services require servers and databases. Over the years
                                I
                                have aquried the knowlege to manage these types of services.</p>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card-panel hoverable" style="height: 350px">
                            <h5 class="center-align card-panel-header"><b>Web Design</b></h5>
                            <p class="flow-text center-align">Using various CSS framworks and JS, I am able to design
                                beautiful, responsive websites with great user interfaces.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" style="z-index: 1000; top: 100px;position:relative">
                <h2 class="center-align">Stuff I do...</h2>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
