<!DOCTYPE html>


<html>

<head>
    <!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

    <meta name="description" content="DriedSponge.net | 403">
    <meta name="keywords" content="Portfolio">
    <meta name="author" content="Jordan Tucker">
    <meta property="og:site_name" content="DriedSponge.net | 403" />

    <?php
    include("meta.php");
    ?>

    <title>Access Denied</title>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php
    include("navbar.php")
    ?>


    <div class="app">
        <div class="container-fluid-lg">



            <div class="container-fluid">
                <div class="content-box">
                    <h1>Error 403!</h1>
                    <h2>Access Denied</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- end of app -->
    <?php
    include("footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="main.js"></script>
    <script>
        $("#back").click(function() {
            window.history.back();

        })
    </script>
    <script>
        navitem = document.getElementById('homelink').classList.add('active')
    </script>

</body>






</html>