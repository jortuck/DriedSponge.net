<?php
$servername = "db.hexaneweb.com";
$username = "driedspo_netuser";
$password = "U7MQioT0uiaoUzzdKnR3sXEOIts4Jt08";

try {
    $conn = new PDO("mysql:host=$servername;dbname=driedspo_net", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Cant connect do database, please contact me on discord DriedSponge#0001");
}

// Because of how it works you can use SQLWrapper()->pdostuff() everywhere as soon
// as it gets loaded
if (function_exists("SQLWrapper")) {
    function SQLWrapper()
    {
        global $conn;
        return $conn;
    }
}
