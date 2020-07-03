@extends('layouts.app')
@section('title','Home')
@section('description',"DriedSponge's Portfolio - Find out info about me and the stuff I make. It's epic guys.")
@section('head')
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div>
        <div class="container" id="landing-header">
            <div><h1 data-aos="fade-down" class="landing-h1 center-align">Dried <span class="white-text">Sponge</span></h1></div>
            <h2 data-aos="fade-up" data-aos-delay="500" class="landing-sub center-align">Full Stack Web Developer</h2>
            <h2 data-aos="fade-up" data-aos-delay="500" class="center-align">
                <a class="icon-link" target="_blank" href="mailto:jordan@driedsponge.net"><i class="fas fa-envelope"></i></a>
                <a class="icon-link" target="_blank" href="https://github.com/DriedSponge"><i class="fab fa-github"></i></a>
                <a class="icon-link" target="_blank" href="https://steamcommunity.com/id/driedsponge/"><i class="fab fa-steam"></i></a>
                <a class="icon-link" target="_blank" href="https://twitter.com/dried_sponge"><i class="fab fa-twitter"></i></a>
                <a class="icon-link" target="_blank" href="https://discord.gg/YS4WZWG"><i class="fab fa-discord"></i></a>

            </h2>
        </div>
    </div>
    <br>
    <div class="section" style="z-index: 900; position: relative; top: 175px">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l4">
                    <div class="hoverable card-panel center-align">
                        <h1>Backend Development</h1>
                        <p class="flow-text">I have expierience with lots of backend development including
                            laravel, python and node js.
                        </p>
                    </div>
                </div>
                <div class="col s12 m6 l4">
                    <div class="hoverable card-panel center-align">
                        <h1>Server Infrastructure</h1>
                        <p class="flow-text">Web services require servers and databases. Over the years I
                            have aquried the knowlege to manage these types of services.
                        </p>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="hoverable card-panel center-align">
                        <h1>Web Design</h1>
                        <p class="flow-text">
                            Using HTML, CSS, and JavaScript, I can transform your design into a beautiful webpage with a great, responsive, user interface.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="width: 100%;height: 300px;background: #62A1EC;">
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
        $(document).ready(function () {
            AOS.init();
        })
    </script>
@endsection
