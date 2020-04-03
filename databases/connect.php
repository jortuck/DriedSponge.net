<?php
$servername = "73.59.72.29";
$username = "networkuser";
$password = "*#fj*2EhdFEmoUV^@zL0vTtfpsIF&U9ME&YCuKpF%NR2xjpcOVEJa61P2#rb9oJy!x3UxLL4Q7Lj";

try {
    $conn = new PDO("mysql:host=$servername;dbname=network", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $request = json_encode([
        "content" => "",
        "embeds" => [
            [
                "title" => "System Error -  MySQL Error",
                "type" => "rich",
                "color" => hexdec("FF0000"),
                "description" =>  $e->getMessage(),
                "timestamp" => date("c"),
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init("https://discordapp.com/api/webhooks/695335752988491839/HOhaC8FXEmYr2URVEr1xKyCQMG7CTQ0PvhrQVuUie7tO_ahYO_4Hn6Gfs49ELhlC7HLC");

    curl_setopt_array($ch, [
        CURLOPT_POST => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_HTTPHEADER => array("Content-type: application/json"),
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_RETURNTRANSFER => 1
    ]);


    curl_exec($ch);
    die("Can't connect to the database. The system just notified me so I'll fix it soon.");
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
