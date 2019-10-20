<?php 
$page = $_GET["page"];

if (!is_numeric($page) || $page < 1){
    $page = 1;
}
include("../meta.php"); 
readfile("lua".$page.".php");
include("../footer.php"); 
?>
        <script>
            tippy('footer button', {

theme: 'footer',
animateFill: false,
})
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
        </script>