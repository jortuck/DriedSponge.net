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
// Errors
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    include('views/404.php');
});
//Indexs
$router->all('/', function () {
    
    include('views/index.php');
});
$router->all('/index.php', function () {
    
    include('views/index.php');
});
$router->all('/home', function () {
    
    include('views/index.php');
});
//Static pages
$router->all('/projects/web', function () {
    include('views/webdesign.php');
});
$router->all('/projects/lua', function () {
    include('views/lua.php');
});
//User pages(pages where user can interacts)
$router->all('/advertise', function () {
    include('views/advertise.php');
});
$router->get('/advertise/{action}', function ($action) {
    include('views/advertise.php');
});
$router->all('/feedback', function () {
    include('views/feedback.php');
});
$router->get('/feedback/{action}', function ($action) {
    include('views/feedback.php');
});
//Controlled pages( pages that can be modified from backend)
$router->all('/legal/privacy', function () {
    include('views/privacy.php');
});
//Steam routes
$router->all('/lookup/{id}', function ($id) {
    include('views/controller.php');
});
$router->get('/steam', function () {
    include('views/steam.php');
 });
 $router->post('/lookup/', function () {
    header("Location: /lookup/".$_POST['id']);
 });
 $router->all('/steam/error', function () {
    include('views/steamerror.php');
});
//Management pages
$router->all('/manage', function () {
    include('views/manage/index.php');
});
$router->all('/manage/home', function () {
    include('views/manage/index.php');
});
$router->all('/manage/index.php', function () {
    include('views/manage/index.php');
});
$router->all('/manage/users', function () {
    include('views/manage/users.php');
});


// Run it!
$router->run();
?>