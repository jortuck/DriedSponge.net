@extends('layouts.app')
@section('title','Home')
@section('description',"DriedSponge's Portfolio - Find out info about me and the stuff I make. It's epic guys.")
@section('content')
    <div class="container">
        <br>
        <div class="text-center">
            <h1 style="font-weight: 900; margin-bottom: 0">DriedSponge</h1>
            <h4 style="margin-top: 5px;font-weight: 900">Full Stack Web Developer</h4>
        </div>
        <br>
        <div class="section">
            <div class="row">
                <div class="col s12 m12">
                    <div class="card">
                        <div class="card-content">
                            <h2 class="center-align">About me</h2>
                            <div class="divider"></div>
                            <br>
                            <p class="center-align flow-text">I am a developer who first started coding on gmod making
                                addons. I then found
                                out that once you know one langauge, it's easier to exapand to others, so that's exactly
                                what I
                                did.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="row">
                <div class="col s12 m4">
                    <div class="card-panel white">
                        <h4 class="center-align">Backend Development</h4>
                        <div class="divider"></div>
                        <p class="flow-text center-align">I have expierience with lots of backend development including
                            laravel, python and node js.</p>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card-panel white">
                        <h4 class="center-align">Server Infrastructure</h4>
                        <div class="divider"></div>
                        <p class="flow-text center-align">Web services require servers and databases. Over the years I
                            have aquried the knowlege to manage these types of services.</p>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card-panel white">
                        <h4 class="center-align">Web Design</h4>
                        <div class="divider"></div>
                        <p class="flow-text center-align">Using various CSS framworks and JS, I am able to design
                            beautiful, responsive websites with great user interfaces.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <h2>Specifics</h2>
            <br>
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">code</i>Backend Devleopment</div>
                    <div class="collapsible-body">
                        <p class="flow-text">Over the years, I've familiarized myself with the following frameworks and languages.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">cloud</i>Server Infrastucture</div>
                    <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">image</i>Web Design</div>
                    <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                </li>
            </ul>
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
