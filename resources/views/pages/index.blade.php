@extends('layouts.app')
@section('title','Home')
@section('description',"DriedSponge's Portfolio - Find out info about me and the stuff I make. It's epic guys.")
@section('head')
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
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
                    <div class="hoverable index-panel card-panel center-align">
                        <h1>Backend Development</h1>
                        <p class="flow-text">
                            I have experience with lots of backend development including Laravel, Python, Java, and Node JS. I use these skills to create websites, Minecraft Plugins, and discord bots.
                        </p>
                    </div>
                </div>
                <div class="col s12 m6 l4">
                    <div class="hoverable index-panel card-panel center-align">
                        <h1>Server Infrastructure</h1>
                        <p class="flow-text">Web services require servers and databases. Over the years I have acquired the knowledge to manage these types of services. I also have experience in setting up and configuring servers for games like Minecraft and Garry's Mod.</p>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="hoverable index-panel card-panel-h card-panel center-align">
                        <h1>Web Design</h1>
                        <p class="flow-text">
                            Using HTML, CSS, and JavaScript, I can transform your design into a beautiful webpage with a great, responsive, user interface & expierience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <h2 class="center-align white-text " style="font-weight: 600;">CONTACT ME</h2>
        <div class="container">
            <p class="center-align flow-text white-text">Is there something I can do for you, or do you just have a general inquiry? Fill out the form below!</p>
            @include('inc.FormMsg')
            <div class="card bg-secondary d-none" id="success-message">
                <div class="card-content">
                    <h3 class="roboto white-text">Success!</h3>
                    <p id="succtext" class="white-text"></p>
                    <br>
                    <button onclick="Reset()" class="btn button-primary">Submit Another Response</button>
                </div>
            </div>
            <div class="card bg-secondary">
                <form id="contact-form">
                    <div class="card-content row">
                        <h2 class="white-text roboto cent-on-med-down">CONTACT</h2>
                        <div class="input-field on-dark col s12 m6 l6">
                            <input id="your_name" type="text" class="validate" maxlength="150">
                            <label for="your_name">Your Name *</label>
                            <span id="your_name-msg" class="helper-text" data-error="" data-success=""></span>
                        </div>
                        <div class="input-field on-dark col s12 m6 l6">
                            <input id="email" maxlength="150" type="text" class="validate">
                            <label for="email">Email *</label>
                            <span id="email-msg" class="helper-text" data-error="" data-success=""></span>
                        </div>
                        <div class="input-field on-dark col s12 m12 l12">
                            <input data-valtarget="send" data-validation="required max=256" id="subject" type="text" class="validate" maxlength="256" data-length="256">
                            <label for="subject">Subject *</label>
                            <span id="subject-msg" class="helper-text" data-error="" data-success="" ></span>
                        </div>
                        <div class="input-field on-dark col s12 m12 l12">
                            <textarea  id="message" class="materialize-textarea validate" maxlength="2000" data-length="2000"></textarea>
                            <label for="message">Message *</label>
                            <span id="message-msg" class="helper-text" data-error="" data-success="" ></span>
                        </div>
                        <div class="col s12 m12 l12">
                            <div id="captcha" class="captcha"></div>
                            <input type="hidden" value="" id="captcha_token">
                            <button id="send" class="btn-large button-primary d-none" type="submit">SUBMIT</button>
                        </div>
                    </div>
                </form>
                <script type="text/javascript">
                    console.log($('#message').val());
                    $('#contact-form').submit(function(e) {
                        e.preventDefault()
                        $(this).hide()
                        $('#loading').removeClass('d-none');
                        axios({
                            method: 'post',
                            url: '{{route('contact.send')}}',
                            data: {
                                captcha_token: $("#captcha_token").val(),
                                your_name: $("#your_name").val(),
                                email: $("#email").val(),
                                subject:$("#subject").val(),
                                message:$('#message').val()
                            }
                        })
                        .then(function(response) {
                            $('#loading').addClass('d-none');
                            if (response.data.success) {
                                $("#succtext").html(response.data.success);
                                $('#success-message').removeClass('d-none')
                            } else {
                                $('#contact-form').show()
                                if (response.data.error) {
                                    AlertMaterializeError(response.data.error);
                                }
                                if (response.data.captcha) {
                                    RegenCap()
                                    AlertMaterializeError(response.data.captcha);
                                }
                                // $.each(response.data, function(key, value) {
                                //     window.MaterialInvalidate('#' + key, value)
                                // });
                                var r = response.data;
                                for (var key in r){
                                    window.MaterialInvalidate('#' + key, r[key])
                                }
                            }
                        });
                    })
                    function Reset(){
                        RegenCap()
                        CreateNewResponse('#contact-form')
                    }
                    VerifyCallback = function(response) {
                        $('#send').removeClass('d-none')
                        $('#captcha_token').attr('value',response)
                        $('#captcha').addClass('d-none')
                    }
                    ExpiredCallback = function (response) {
                        $('#captcha').removeClass('d-none')
                        $('#captcha_token').attr('value','botmaybe')
                        $('#send').addClass('d-none')
                    }
                    ErrorCallback = function (response) {
                        AlertMaterializeError('Captcha faild, please try again.')
                    }
                    function RegenCap(){
                        $('#captcha').removeClass('d-none')
                        $('#captcha_token').attr('value','botmaybe')
                        $('#send').addClass('d-none')
                        grecaptcha.reset();
                    }
                    var onloadCallback = function() {
                        grecaptcha.render('captcha', {
                            'sitekey' : '6LczSMcZAAAAADwXi4U34KxHyS324gn0T275nLTI',
                            'theme': 'dark',
                            'callback':VerifyCallback,
                            'expired-callback':ExpiredCallback,
                            'error-callback':ErrorCallback
                        });
                    };
                </script>
            </div>
        </div>
    </div>
    <script>

        $(()=>{
            console.log("Document Ready");
        });
        $(()=>{
            // const textNeedCount = $('textarea, input[data-length]');
            // const textNeedCountInstance = new M.CharacterCounter(textNeedCount);
        });
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
        $(()=>{
            AOS.init();
        })
    </script>
@endsection
