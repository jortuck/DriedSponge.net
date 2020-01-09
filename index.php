<?php
require "Bramus/Router/Router.php";
include ("databases/connect.php");
$router = new \Bramus\Router\Router();

$router->get('pattern', function() { /* ... */ });
$router->post('pattern', function() { /* ... */ });
$router->put('pattern', function() { /* ... */ });
$router->delete('pattern', function() { /* ... */ });
$router->options('pattern', function() { /* ... */ });
$router->patch('pattern', function() { /* ... */ });

// Define routes
// ...
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    include('views/404.php');
});
$router->all('/', function () {
    
    include('views/index.php');
});
$router->all('/index.php', function () {
    
    include('views/index.php');
});
$router->all('/home', function () {
    
    include('views/index.php');
});
//Steam routes
$router->get('/lookup/{id}', function ($id) {
    include('views/controller.php');
});
$router->get('/steam', function () {
    include('views/steam.php');
 });
 $router->post('/lookup/', function () {
    header("Location: /lookup/".$_POST['id']);
 });

// Run it!
$router->run();
?>