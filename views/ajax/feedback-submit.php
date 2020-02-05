<?php
header('Content-type: application/json');

$Message = array(
    "success" => false, // "suck this" hehe
    "message" => "Something went wrong I guess"
);

if (isset($_POST['submit'])) {

    if (isset($steamprofile['steamid'])) {
        if(!isBlocked($_SESSION['steamid'])){
        $feedback = $_POST['say'];

        if (IsEmpty($feedback)) {
            $Message["message"] = "Feedback was empty!";
        } else if (strlen($feedback) < 1000) {


            $request = json_encode([
                "content" => "",
                "embeds" => [
                    [
                        "author" => [
                            "name" => $steamprofile['personaname'] . " (" . $steamprofile['steamid'] . ")",
                            "url" => $steamprofile['profileurl'],
                            "icon_url" => $steamprofile['avatarmedium']
                        ],
                        "title" => "DriedSponge.net - Feedback",
                        "type" => "rich",
                        "description" =>  $_POST['say'],
                        "timestamp" => date("c"),
                    ]
                ]
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $ch = curl_init("https://discordapp.com/api/webhooks/650866821095882762/Y-Sf_yCTGDKSh_hm8nSkvAphQQyl8KtPxISx6NSQ1t3daUVhobXKX1EW-E-wqseC7ndf");

            curl_setopt_array($ch, [
                CURLOPT_POST => 1,
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_HTTPHEADER => array("Content-type: application/json"),
                CURLOPT_POSTFIELDS => $request,
                CURLOPT_RETURNTRANSFER => 1
            ]);


            curl_exec($ch);

            //echo "<h1>GoodJob</h1>";
            // header("Location: feedback.php?submit-success");

            $Message = array(
                "success" => true, // "suck this" hehe
                "message" => "Thank you for submitting feedback!<br><i class=\"fas fa-check\"></i>"
            );
        } else {
            $Message["message"] = "The text you entered is too long, please reduce the length to a maximum of 1000 characters.";

        }
    }else{
        $Message["message"] = "You are not allowed to do this!";
    }
    } else {
        $Message["message"] = "You need to be logged in for this!";
    }
}

die(json_encode($Message));

