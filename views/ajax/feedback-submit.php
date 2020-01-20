<?php

$Message = array(
    "success" => false, // "suck this" hehe
    "message" => "Unkown error occoured"
);

if (isset($_POST['submit'])) {

    if (isset($steamprofile['steamid'])) {
        $feedback = $_POST['say'];

        if (empty($feedback)) {
            $errorEMPTY = true;
        } else if (strlen($feedback) < 1000) {

            /*
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
                */
            $errorEMPTY = false;
            $SubmitSuccess = true;
            $SubmitFailed = false;
            //echo "<h1>GoodJob</h1>";
            // header("Location: feedback.php?submit-success");

        } else {
            $errorLONG = true;
        }
    } else {

        $SubmitFailed = true;
    }
} else {

    $SubmitFailed = true;
}

die(json_encode($Message));
/*
<script>
var errorEMPTY = <?php echo $errorEMPTY ? 'true' : 'false';; ?>;
var SubmitSuccess = <?php echo $SubmitSuccess ? 'true' : 'false';; ?>;
var errorLONG = <?php echo $errorLONG ? 'true' : 'false';; ?>;
var SubmitFailed = <?php echo $SubmitFailed ? 'true' : 'false';; ?>;
if(errorEMPTY){
    $("#say").addClass("is-invalid");
    $("#say-feedback").addClass("invalid-feedback");
    document.getElementById("say-feedback").innerHTML = "Please enter some content";
}
if(errorLONG){
    $("#say").addClass("is-invalid");
    $("#say-feedback").addClass("invalid-feedback");
    document.getElementById("say-feedback").innerHTML = "The response you entered is too long, please reduce the length to a maximum of 1000 characters.";
}
if(SubmitSuccess){
    $("#feedback-form").remove();
    document.getElementById("feedback-response").innerHTML = '<p class="text-success">Thank you for submitting feedback!<br><i class="fas fa-check"></i></p>';
}
if(SubmitFailed){
    $("#feedback-form").remove();
    document.getElementById("feedback-response").innerHTML = '<p class="text-danger">Something when wrong I guess</p>';
}
</script>
*/
