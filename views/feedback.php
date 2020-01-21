<!DOCTYPE html>


<html>

<head>
    <!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

    <meta name="description" content="Sumbit feedback about my site">
    <meta name="keywords" content="feedback, driedsponge.net feedback">
    <meta name="author" content="Jordan Tucker">
    <meta property="og:site_name" content="DriedSponge.net | Feedback" />

    <?php
    include("views/includes/meta.php");
    ?>

    <title>Feedback</title>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {
                event.preventDefault();
                var say = $("#say").val();
                $("#wait-message").removeClass("d-none");
                $("#error-message").addClass("d-none");
                $("#success-message").addClass("d-none");
                $("#feedback-form").hide();

                console.log(say);
                //$("#form-message").load("/pages/ajax/feedback-submit.php",{
                //    say: say,
                //    submit: submit
                //});
                $.post("/pages/ajax/feedback-submit.php", {
                        say: say,
                        submit: 1
                    })
                    .done(function(data) {
                        console.log(data);
                        $("#wait-message").addClass("d-none");
                        if (data.success) {
                            $("#success-message").removeClass("d-none");
                            $("#success_message_text").html(data.message);
                        } else {
                            $("#error-message").removeClass("d-none");
                            $("#error_message_text").html(data.message);
                            $("#feedback-form").show();
                        }
                    });
            });
        });
    </script>
</head>

<body>
    <?php
    include("views/includes/navbar.php")
    ?>
    <?php
    $blocked = false;
    if (isset($_SESSION['steamid'])) {
        $PLogin = false;
        $Done = false;


        $FailedCaptch = false;
        $blocked = false;
        $row = null;
        $chekid = $_SESSION['steamid'];

        $sqlblockexistquery = SQLWrapper()->prepare("SELECT id64, rsn, stamp FROM blocked WHERE id64 = :id");
        $sqlblockexistquery->execute([':id' => $chekid]);

        $row = $sqlblockexistquery->fetch();
        if (!empty($row)) {
            $DisplayForm = false;
            $blocked = true;
        } else {
            $DisplayForm = true;
        }
    } else {
        $DisplayForm = false;
        $PLogin = true;
    }
    ?>
    <div class="app">
        <div class="container-fluid-lg" style="padding-top: 80px;">

            <div class="container">
                <hgroup>
                    <h1 class="display-2"><strong>Feedback</strong></h1>
                </hgroup>
                <br>
                <?php if ($blocked == true) { ?>
                    <h1 class="text-alert text-danger">Error: Banned <br> Reason: <?= htmlspecialchars($row["rsn"]); ?></h1>
                <?php
                }
                ?>
                <?php
                if ($DisplayForm) {
                ?>

                    <p class="paragraph pintro">Tell me what you think about the site and what could be changed. Both positive and negative feedback are accepted!</p>
                    <br>
                    <div class="text-center" id="feedback-response">
                        <div id="error-message" class="d-none">
                            <div class="alert alert-danger" role="alert">
                                <span><b>Error:</b> <span id="error_message_text"><i>insert success message here</i></span></span>
                            </div>
                        </div>
                        <div id="success-message" class="d-none">
                            <div class="alert alert-success" role="alert">
                                <span><b>Success:</b> <span id="success_message_text"><i>insert success message here</i></span></span>
                            </div>
                        </div>
                        <div id="wait-message" class="d-none">
                            <div class="alert alert-secondary" role="alert">
                                <span> please wait while im loading... </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <form id="feedback-form" action="/pages/ajax/feedback-submit.php" method="POST">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="<?= htmlspecialchars($steamprofile['personaname']); ?>" placeholder="<?= htmlspecialchars($steamprofile['personaname']); ?>" readonly>
                            <br>
                            <label for="say">What are your thoughts on the site?</label>
                            <div id="saydiv">
                                <textarea id="say" maxlength="1000" class="form-control" name="say" rows="5" placeholder="Type here I guess..."></textarea>
                                <div id="say-feedback"></div>
                            </div>
                            <br>
                            <div id="form-message"></div>
                            <button name="submit" type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                <?php
                }

                if ($PLogin == true) {
                ?>
                    <h1 class="articleh1">Please login to submit feedback</h1>
                    <br>
                    <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
                <?php
                }
                ?>


            </div>
        </div>

    </div>
    <!-- end of app -->
    <?php
    include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="main.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


</body>






</html>