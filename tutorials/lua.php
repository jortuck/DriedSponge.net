<?php 
$page = $_GET["page"];





if (!is_numeric($page) || $page < 1){
    $page = 1;
}
if (!is_numeric($page) || $page > 2){
    $page = 1;
}

readfile("lua".$page.".php");
include("../footer.php"); 
include("../meta.php"); 
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