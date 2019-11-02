<?php 
$page = $_GET["page"];





if (!is_numeric($page) || $page < 1){
    header("Location: https://driedsponge.net/404.php");
}
if (!is_numeric($page) || $page > 3){
    header("Location: https://driedsponge.net/404.php");
}

readfile("lua".$page.".php");
include("../meta.php"); 
include("../hex.php");
include("../footer.php"); 

include("navbar.php");

?>

<!--         <script>

             var date = new Date();
        if (date.getMonth() == 9)
                    {
                    var spookfavicon = document.getElementById('favicon');
                    spookfavicon.href = "https://cdn.driedsponge.net/img/favicon-spook.ico"
                    var css = document.getElementById('styless');
                    css.href = "../spook.css"
                    document.getElementById('themefoot').innerHTML = "Spooky";
                    } else {
                    document.getElementById('themefoot').innerHTML = "Normal";
                    }
        </script> -->
        <script>
            tippy('footer button', {

            theme: 'footer',
            animateFill: false,
            })
        </script>
        <script>
                navitem = document.getElementById('tut').classList.add('active')
                
    </script>
