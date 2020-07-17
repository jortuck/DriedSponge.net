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
            <h2 class="landing-sub center-align">Full Stack Web Developer</h2>
            <h2 class="center-align">
                <a class="icon-link" target="_blank" href="https://github.com/DriedSponge"><i class="fab fa-github"></i></a>
                <a class="icon-link" target="_blank" href="https://steamcommunity.com/id/driedsponge/"><i class="fab fa-steam"></i></a>
                <a class="icon-link" target="_blank" href="https://twitter.com/dried_sponge"><i class="fab fa-twitter"></i></a>
                <a class="icon-link" target="_blank" href="https://discord.gg/YS4WZWG"><i class="fab fa-discord"></i></a>
            </h2>
        </div>
    </div>
    <br>
    <br>
    <div class="section colored-section-1 z-depth-5">
        <h1 class="center-align white-text section-header">WHAT I DO</h1>
        <br>
        <div class="container">
            <div class="row same-h-row">
                <div class="col s12 m6 l4">
                    <div class="hoverable card-panel center-align">
                        <h1>Backend Development</h1>
                        <p class="flow-text">
                            I have experience with lots of backend development including Laravel, Python and Node JS. I use these skills to create websites and discord bots.
                        </p>
                    </div>
                </div>
                <div class="col s12 m6 l4">
                    <div class="hoverable card-panel center-align">
                        <h1>Server Infrastructure</h1>
                        <p class="flow-text">Web services require servers and databases. Over the years I have acquired the knowledge to manage these types of services. I also have experience in setting up and configuring servers for games like Minecraft and Garry's Mod.</p>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="hoverable card-panel-h card-panel center-align">
                        <h1>Web Design</h1>
                        <p class="flow-text">
                            Using HTML, CSS, and JavaScript, I can transform your design into a beautiful webpage with a great, responsive, user interface & expierience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section" style="background: #0E1013;">
        <h2 class="center-align white-text" style="font-weight: 600;">CONTACT ME</h2>
        <div class="container">
            <p class="center-align flow-text white-text">Is there something I can do for you, or do you just have a general inquiry? Fill out the form below!</p>
            <div class="card bg-secondary">
                <form>
                    <div class="card-content row">
                        <h2 class="white-text roboto cent-on-med-down">CONTACT</h2>
                        <div class="input-field col s12 m12 l4">
                            <input id="your_name" type="text" class="validate" maxlength="50" data-length="50">
                            <label for="your_name">Your Name *</label>
                            <span id="your_name-msg" class="helper-text" data-error="" data-success=""></span>
                        </div>
                        <div class="input-field col s12 m12 l4">
                            <input id="email" type="text" class="validate">
                            <label for="email">Email *</label>
                            <span id="email-msg" class="helper-text" data-error="" data-success=""></span>
                        </div>
                        <div class="input-field col s12 m12 l4">
                            <input id="subject" type="text" class="validate" maxlength="50" data-length="50">
                            <label for="subject">Subject *</label>
                            <span id="subject-msg" class="helper-text" data-error="" data-success="" ></span>
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <textarea id="textarea1" class="materialize-textarea" maxlength="1000" data-length="1000"></textarea>
                            <label for="textarea1">Message *</label>
                            <label for="textarea1">Message *</label>
                        </div>
                    </div>
                    <div class="card-action">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('textarea, input').characterCounter();
        });
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
        $(document).ready(function () {
            AOS.init();
        })
    </script>
@endsection
