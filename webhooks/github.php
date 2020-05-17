<?php
$secret = $_ENV['GITHUB_SECRET'];
if(isset($_POST['payload'])){
    echo "Payload detected<br>";
    $postBody = file_get_contents( 'php://input' ); 
    $ContentType === 'application/json';
    $data = json_decode($_POST['payload'],true);
    $hook = $data['hook'];
    $events = $hook['events'];
    $config = $data['config'];
    if( 'sha1=' . hash_hmac( 'sha1', $postBody, $secret, false ) === $_SERVER[ 'HTTP_X_HUB_SIGNATURE' ]){
        echo "Secret Passed";
        $request = json_encode([
            "content" => "",
            "embeds" => [
                [
                    "title" => "Test",
                    "type" => "rich",
                    "color" => hexdec("FF0000"),
                    "description" => "test",
                    "timestamp" => date("c"),
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    
        $ch = curl_init("https://discordapp.com/api/webhooks/711614013758373918/dAefs0xJja_o3gtNwRnztJLDu2m-KVl1RItBBJMW5Z25b2K_3_KMQDE0TroLQk5wD9pW");
    
        curl_setopt_array($ch, [
            CURLOPT_POST => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_HTTPHEADER => array("Content-type: application/json"),
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_RETURNTRANSFER => 1
        ]);
    
    
        curl_exec($ch);
    }else{
        echo "Invalid Token<br>";
    }
}else{
    echo "Unauthorized<br>";
}