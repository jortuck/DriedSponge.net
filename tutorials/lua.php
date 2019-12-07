<?php
require('../steamauth/steamauth.php');  
?>
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
include("navbar.php");
include("../hex.php");
include("../footer.php"); 



?>
<style>
img{
    max-width: 650px;
}

</style>
        <script>
            tippy('footer button', {

            theme: 'footer',
            animateFill: false,
            })
        </script>
        <script>
                navitem = document.getElementById('tut').classList.add('active')
                
    </script>
