<?php
$servername = "73.59.72.29";
$username = "networkuser";
$password = "*#fj*2EhdFEmoUV^@zL0vTtfpsIF&U9ME&YCuKpF%NR2xjpcOVEJa61P2#rb9oJy!x3UxLL4Q7Lj";

try {
    $conn = new PDO("mysql:host=$servername;dbname=network", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Cant connect do database, please contact me on discord DriedSponge#0001");
}

// Because of how it works you can use SQLWrapper()->pdostuff() everywhere as soon
// as it gets loaded
if (!function_exists("SQLWrapper")) {
    /**
     * PDO Wrapper for current connections
     *
     * @return \PDO
     */
    function SQLWrapper()
    {
        global $conn;
        return $conn;
    }
}
