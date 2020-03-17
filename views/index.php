<!DOCTYPE html>


<html>

<head>
    <!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

    <meta name="description"
        content="DriedSponge's Portfolio - Find out info about me and the stuff I make. It's epic guys.">
    <meta name="keywords" content="Portfolio">
    <meta name="author" content="Jordan Tucker">
    <meta property="og:site_name" content="DriedSponge.net | Home" />

    <?php
    include("views/includes/meta.php");
    ?>

    <title>DriedSponge.net</title>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>




</head>

<body>
    <?php
    include("views/includes/navbar.php");
    $motdq = SQLWrapper()->prepare("SELECT content, UNIX_TIMESTAMP(stamp) AS stamp, created FROM content WHERE thing = :thing");
    $motdq->execute([':thing' => "motd"]);
    $content = $motdq->fetch();
    $mlastupdated = date("m/d/Y g:i a", $content["stamp"]);
    $mcreatedby = $content["created"];
    $mcreatedbyurl = "https://steamcommunity.com/profiles/" . $mcreatedby . "/";
    ?>

    <div class="app">
        <div class="container-fluid-lg">


            <div class="container-fluid">
                <hgroup>
                    <h1 class="display-2"><strong>Welcome</strong></h1>
                </hgroup>
                <br>
                <br>
                <div class="content-box" data-aos="zoom-in">
                    <h1 class="heading">About Me</h1>
                    <p class="paragraph" style="text-align: center;">I am a developer that primarily focuses on full
                        stack web development. I also develop discord bots and Garry's Mod addons.</p>
                </div>
                <br>
                <div class="content-box" data-aos="zoom-in">
                    <h1 class="heading" style="text-align: center;">What I do...</h1>
                    <br>
                    <div class="container">
                        <div class="row display-flex">
                            <div class="col indexcol">
                                <div class="card card-border">
                                    <div class="card-body">
                                        <img src="../img/html.png" alt="html5logo" class="img-fluid"
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
                                        <img src="../img/lua.png" alt="lualogo" height="100px" class="img-fluid"
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
                                        <img src="../img/php.png" alt="phplogo" height="100px" class="img-fluid"
                                            style="max-height:100px;" />
                                        <p class="paragraph" style="text-align: center;">PHP is my favorite language.
                                            This is becuase I am the most skilled in the backend department and it's
                                            pretty cool in general (although some might disagree).</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row display-flex">
                            <div class="col indexcol">
                                <div class="card card-border">
                                    <div class="card-body">
                                        <img src="../img/css.png" alt="csslogo" height="100px" class="img-fluid"
                                            style="max-height:100px;" />
                                        <p class="paragraph" style="text-align: center;">While my knowledge in CSS is
                                            acceptable, I lack skills in the creativity department.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col indexcol">

                                <div class="card card-border">
                                    <div class="card-body">
                                        <img src="../img/js.png" alt="jslogo" height="100px" class="img-fluid"
                                            style="max-height:100px;" />
                                        <p class="paragraph" style="text-align: center;">I consider my Javascript to be
                                            adequate. I am very failiar with jQuery and NodeJS.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col indexcol">

                                <div class="card card-border">
                                    <div class="card-body">
                                        <img src="https://i.driedsponge.net/images/png/6Awqx.png" alt="tux"
                                            height="100px" class="img-fluid" style="max-height:100px;" />
                                        <p class="paragraph" style="text-align: center;">I'm very good with the linux
                                            operating system, specifcally Ubuntu Server. I'm currently hosting this
                                            website
                                            on my own servers!</p>
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

    </div>
    <!-- end of app -->
    <?php
    include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="main.js"></script>
    <script>
        navitem = document.getElementById('homelink').classList.add('active')
    </script>
    <script>
        AOS.init();
    </script>
</body>






</html>