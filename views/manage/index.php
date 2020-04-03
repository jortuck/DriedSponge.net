<!DOCTYPE html>


<html>

<head>
    <!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

    <meta name="description" content="Admins only guys">
    <meta name="keywords" content="driedsponge.net mange">
    <meta name="author" content="Jordan Tucker">
    <meta property="og:site_name" content="DriedSponge.net | Mangement" />

    <?php
    include("views/includes/meta.php");
    ?>

    <title>Manage - Users</title>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css">

</head>

<body>

    <?php
    include("views/includes/navbar.php");

    ?>
    <style>
        .dropdown-head-link {
            color: black;
            text-decoration: none;

        }

        .dropdown-head-link:hover {
            color: black;
            text-decoration: underline;

        }
    </style>

    <div class="app">
        <div class="container-fluid-lg">

            <div class="container-fluid">

                <?php
                if (isset($_SESSION['steamid'])) {
                    if (isAdmin($_SESSION['steamid'])) {


                ?>
                        <?php
                        include("views/includes/manage/navtab.php");
                        ?>
                        <br>
                        <hgroup>
                            <h1 class="display-2"><strong>Management Home</strong></h1>
                        </hgroup>
                        <br>
                        <div class="content-box">
                            <h1>Recent Actions</h1>
                            <table class="table paragraph text-center" style="color: black;">
                                
                                <tbody id="recent-logs">
                                    <?php
                                    $query = SQLWrapper()->prepare("SELECT User,Msg,UNIX_TIMESTAMP(Time) AS Time FROM Logs_Admin  ORDER BY Time DESC LIMIT 10");
                                    $query->execute();
                                    $data = $query->fetchAll();
                                    foreach($data as $log){
                                        $user = json_decode($log['User'],true);
                                        $action = $log['Msg']
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $action; ?> - <?=v(date(("m/d/y  g:i A"),$log['Time']))?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <br>

                    <?php } else { ?>
                        <hgroup>
                            <h1 class="display-2"><strong>You are not management, get out!</strong></h1>
                            <?php
                            header("Location: /home/");
                            ?>

                        </hgroup>

                    <?php
                    }
                } else {
                    ?>
                    <h1 class="articleh1">Please login to manage.</h1>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="main.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        navitem = document.getElementById('hometab').classList.add('active')
    </script>

</body>

</html>