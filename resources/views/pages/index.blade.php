@extends('layouts.app')
@section('title','Home')
@section('description',"DriedSponge's Portfolio - Find out info about me and the stuff I make. It's epic guys.")
@section('content')
    <div>
        <div class="container" id="landing-header">
            <div><h1 class="landing-h1 center-align">Dried <span class="white-text">Sponge</span></h1></div>
            <h2 class="landing-sub center-align">Full Stack Web Developer</h2>
        </div>
    </div>
    <br>
    <div class="section" style="top: 125px; z-index: 900; position: relative">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l4">
                    <div class="card-panel center-align">
                        <h1>Backend Development</h1>
                        <p class="flow-text">I have expierience with lots of backend development including
                            laravel, python and node js.
                        </p>
                    </div>
                </div>
                <div class="col s12 m6 l4">
                    <div class="card-panel center-align">
                        <h1>Server Infrastructure</h1>
                        <p class="flow-text">Web services require servers and databases. Over the years I
                            have aquried the knowlege to manage these types of services.
                        </p>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="card-panel center-align">
                        <h1>Web Design</h1>
                        <p class="flow-text">
                            Using HTML, CSS, and JavaScript, I can transform your design into a beautiful webpage with a great user interface.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="width: 100%;height: 250px;background: #62A1EC;">
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
