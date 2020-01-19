<?php
require "Bramus/Router/Router.php";
include ("databases/connect.php");
include ("src/libs/functions.php");

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
    $header = "/home";
    require('steamauth/steamauth.php');  
    include('views/index.php');
});
$router->all('/index.php', function () {
    $header = "/home";
    require('steamauth/steamauth.php');  
    include('views/index.php');
});
$router->all('/home', function () {
    $header = "/home";
    require('steamauth/steamauth.php');  
    include('views/index.php');
});
//Static pages
$router->all('/projects/web', function () {
    $header = "/web/";
    require('steamauth/steamauth.php');  
    include('views/webdesign.php');
});
$router->all('/projects/lua', function () {
    $header = "/lua/";
    require('steamauth/steamauth.php');  
    include('views/lua.php');
});
//User pages(pages where user can interacts)
$router->all('/pages/ajax/{ajax}', function ($ajax) {
    require('steamauth/steamauth.php');  
    include ('steamauth/userInfo.php');
    include('views/ajax/'.$ajax);
});
$router->all('/advertise', function () {
    $header = "/advertise/";
    require('steamauth/steamauth.php');  
    include('views/advertise.php');
});
$router->get('/advertise/{action}', function ($action) {
    $header = "/advertise/".$action;
    require('steamauth/steamauth.php');  
    include('views/advertise.php');
});
$router->all('/feedback', function () {
    $header = "/feedback/";
    require('steamauth/steamauth.php');  
    include('views/feedback.php');
});
$router->all('/verify', function () {
    $header = "/verify/";
    require('steamauth/steamauth.php');  
    include('views/verify.php');
});
$router->get('/verify/{id}', function ($verify) {
    $header = "/verify/".$verify;
    require('steamauth/steamauth.php');  
    include('views/verify.php');
});
//Steam routes
$router->all('/lookup/{id}', function ($id) {
    $header = "/lookup/$id";
    require('steamauth/steamauth.php');  
    include('views/controller.php');
});
$router->get('/steam', function () {
    $header = "/steam/";
    require('steamauth/steamauth.php');  
    include('views/steam.php');

 });
 $router->post('/lookup/', function () {
    $header = "/lookup/".$_POST['id'];
    require('steamauth/steamauth.php');  
    header("Location: /lookup/".$_POST['id']);
 });
 $router->all('/steam/error', function () {
    $header = "/steam/error";
    require('steamauth/steamauth.php');  
    include('views/steamerror.php');
});
//Management pages
$router->all('/manage', function () {
    $header = "/manage/home";
    require('steamauth/steamauth.php');  
    include('views/manage/index.php');
});
$router->all('/manage/home', function () {
    $header = "/manage/home";
    require('steamauth/steamauth.php');  
    include('views/manage/index.php');
});
$router->all('/manage/ajax/{ajax}', function ($ajax) {
    require('steamauth/steamauth.php');  
    include ('steamauth/userInfo.php');
    include('views/manage/ajax/'.$ajax);
});
$router->all('/manage/index.php', function () {
    $header = "/manage/home";
    require('steamauth/steamauth.php');  
    include('views/manage/index.php');
});
$router->all('/manage/users', function () { //Users Manage
    $header = "/manage/users/";
    require('steamauth/steamauth.php');  
    include('views/manage/users.php');
});
$router->get('/manage/users/{action}', function ($action) { //Users Manage Action
    $header = "/manage/users/";
    require('steamauth/steamauth.php');  
    include('views/manage/users.php');
});
$router->all('/manage/content', function () { //Cotnent Manage
    $header = "/manage/content/";
    require('steamauth/steamauth.php');  
    include('views/manage/content.php');
});
$router->get('/manage/content/{action}', function ($action) { //Content Manage Actions
    $header = "/manage/content/";
    require('steamauth/steamauth.php');  
    include('views/manage/content.php');
});
$router->get('/manage/edit/{pageid}/{action}', function ($pageid,$action) { //Editor Manage Actions
    $header = "/manage/edit/".$pageid;
    require('steamauth/steamauth.php');  
    include('views/manage/editor.php');
});
$router->all('/manage/edit/{pageid}', function ($pageid) { //Editor Manage
    $header = "/manage/edit/".$pageid;
    require('steamauth/steamauth.php');  
    include('views/manage/editor.php');
});

$router->all('/{slug}/', function ($slug) { //Editor Manage
    $header = "/".$slug."/";
    require('steamauth/steamauth.php');  
    include('views/page.php');
});

// Run it!
$router->run();
?>