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
        <div class="container-fluid-lg">
            <hgroup>
                <h1 class="display-2"><strong>Feedback</strong></h1>
            </hgroup>
            <br>
            <div class="container-fluid">

                <?php if ($blocked == true) { ?>
                    <div data-aos="zoom-in" class="content-box">
                        <h1 class="heading">Error!</h1>
                        <p class="paragraph text-center">Uh oh, looks like you have been blacklisted from submitting form data. <br> Reason: <?= htmlspecialchars($row["rsn"]); ?></p>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($DisplayForm) {
                ?>
                    <div class="content-box">
                        <h1>Submit Feedback</h1>
                        <p class="text-center">Tell me what you think about the site and what could be changed. Both positive and negative feedback are accepted!</p>
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
                            <div id="wait-message">
                            </div>
                        </div>
                        <br>
                        <script>
                            $(document).ready(function() {
                                $("form").submit(function(event) {
                                    event.preventDefault();
                                    var say = $("#say").val();
                                    Loading(true, "#wait-message");
                                    $("#error-message").addClass("d-none");
                                    $("#success-message").addClass("d-none");
                                    $("#feedback-form").hide();
                                    console.log(say);
                                    $.post("/pages/ajax/feedback-submit.php", {
                                            say: say,
                                            submit: 1
                                        })
                                        .done(function(data) {
                                            console.log(data);
                                            Loading(false, "#wait-message");
                                            if (data.success) {
                                                $("#success-message").removeClass("d-none");
                                                $("#success_message_text").html(data.message);
                                            } else {
                                                $("#error-message").removeClass("d-none");
                                                $("#say").addClass("is-invalid");
                                                $("#error_message_text").html(data.message);
                                                $("#feedback-form").show();
                                            }
                                        });
                                });
                            });
                        </script>
                        <form id="feedback-form">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" class="form-control form-control-alternative" value="<?= htmlspecialchars($steamprofile['personaname']); ?>" placeholder="<?= htmlspecialchars($steamprofile['personaname']); ?>" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="say">What are your thoughts on the site?</label>
                                <textarea id="say" maxlength="1000" class="form-control form-control-alternative" name="say" rows="8" placeholder="Type here I guess..."></textarea>
                                <div id="say-feedback"></div>
                            </div>
                            <br>
                            <div id="form-message"></div>
                            <button name="submit" type="submit" id="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                <?php
                }

                if ($PLogin == true) {
                ?>
                    <div class="content-box" data-aos="zoom-in">
                        <h1 class="heading">Please login to submit feedback</h1>
                        <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
                        <br>
                        <p class="paragraph text-center">This is required so we can prevent spam and know who's sending feedback.</p>
                    </div>
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
    <script>
        AOS.init();
    </script>

</body>






</html>