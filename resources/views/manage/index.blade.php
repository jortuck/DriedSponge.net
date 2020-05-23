@extends('layouts.manage')
@section('title','Dashboard')
@section('description',"Manage stuff here")
@section('content')
<div class="container-fluid-lg">
    <div class="container-fluid">
        <br>
        <div class="content-box" >
            <h1 class="heading">About Me</h1>
            <p class="paragraph" style="text-align: center;">I am a developer who first started coding on gmod making addons. I then found out that once you know one langauge, it's easier to exapand to others, so that's exactly what I did.</p>
        </div>
        <br>
        <div class="content-box" >
            <h1 class="heading" style="text-align: center;">What I do...</h1>
            <br>
            <div class="container">
                <div class="row display-flex">
                    <div class="col indexcol">
                        <div class="card card-border">
                            <div class="card-body">
                            <img data-src="{{asset('images/html.png')}}" alt="html5logo" class="img-fluid lozad"
                                    style="max-height:100px;" />
                                <p class="paragraph" style="text-align: center;">Lets be honest, HTML is nothing
                                    without CSS. Some people don't even consider it a language because it's so
                                    easy to learn (hint: you should learn it becuase it's easy)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col indexcol">
                        <div class="card card-border">
                            <div class="card-body">
                                <img data-src="{{asset('images/lua.png')}}" alt="lualogo"  class="img-fluid lozad"
                                    style="max-height:100px;" />
                                <p class="paragraph" style="text-align: center;">Lua was the first language I
                                    started on. I used it to make crappy gmod addons. I have moved on from Lua
                                    and don't really use it anymore, but it was a great start.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col indexcol">

                        <div class="card card-border">
                            <div class="card-body">
                                <img data-src="{{asset('images/php.png')}}" alt="phplogo"  class="img-fluid lozad"
                                    style="max-height:100px;" />
                                <p class="paragraph" style="text-align: center;">PHP is my favorite language.
                                    This is becuase I am the most skilled in the backend department and it's
                                    pretty cool in general (although some might disagree). I use the laravel framework for most of my projects.</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row display-flex">
                    <div class="col indexcol">
                        <div class="card card-border">
                            <div class="card-body">
                                <img data-src="{{asset('images/css.png')}}" alt="csslogo"  class="img-fluid lozad"
                                    style="max-height:100px;" />
                                <p class="paragraph" style="text-align: center;">While my knowledge in CSS is
                                    acceptable, I lack skills in the creativity department.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col indexcol">

                        <div class="card card-border">
                            <div class="card-body">
                                <img data-src="{{asset('images/js.png')}}" alt="jslogo"  class="img-fluid lozad"
                                    style="max-height:100px;" />
                                <p class="paragraph" style="text-align: center;">I consider my Javascript to be
                                    adequate. I am very familiar with jQuery and NodeJS.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col indexcol">

                        <div class="card card-border">
                            <div class="card-body">
                                <img data-src="https://i.driedsponge.net/images/png/6Awqx.png" alt="tux"
                                     class="img-fluid lozad" style="max-height:100px;" />
                                <p class="paragraph" style="text-align: center;">I'm very good with the linux
                                    operating system, specifcally Ubuntu Server. I'm currently hosting this
                                    website
                                    on my own servers!</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row display-flex">
                    <div class="col indexcol">
                        <div class="card card-border">
                            <div class="card-body">
                                <img data-src="https://i.driedsponge.net/images/png/9ZaIe.png" alt="C Sharp Logo"  class="img-fluid lozad"
                                    style="max-height:100px;" />
                                <p class="paragraph" style="text-align: center;">My second favorite language. It's truly amazing what you can do with it. I mainly use it for <a href="https://unity.com/" target="_blank">Unity</a> and creating Windows apps.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col indexcol">

                        <div class="card card-border">
                            <div class="card-body">
                                <img data-src="https://i.driedsponge.net/images/png/2RSZb.png" alt="Unity Logo "  class="img-fluid lozad"
                                    style="max-height:100px;" />
                                <p class="paragraph" style="text-align: center;">Recently, I've been using my C# skills to explore game development with the <a href="https://unity.com/" target="_blank">Unity Game Engine</a>. I haven't made anything worth showing/distributing, but I hope to some day!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <br>
</div>
</div>
<script>
    navitem = document.getElementById('dashlink').classList.add('active')
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection