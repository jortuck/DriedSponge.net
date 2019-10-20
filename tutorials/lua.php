<?php 
$page = $_GET["page"];

if (!is_numeric($page) || $page < 1){
    $page = 1;
}

readfile("lua".$page.".php");

?>