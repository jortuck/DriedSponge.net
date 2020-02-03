<?php
if (isset($_POST['savepage'])) {
    header('Content-type: application/json');
    $Msg = array(
        "success" => false,
        "SysError" => false,
        "basics" => false,
        "errorNAMETXT" => null,
        "errorPRIVACYTXT" => null,
        "errorDESTXT" => null,
        "errorSLGTXT" => null,
        "errorCONTXT" => null,
        "message" => "Something went wrong I guess"
    );
    if (isset($_SESSION['steamid'])) {
        if (isMasterAdmin($_SESSION['steamid'])) {
            $Msg['basics'] = true;
            

            $content = $_POST['content'];
            $privacy = $_POST['privacy'];
            $des = $_POST['description'];
            $thing = $_POST['id'];
            $title = $_POST['title'];
            $changedby = $_SESSION['steamid'];
            $slug =  $_POST['slug'];

            if(empty($title)){
                $Msg["errorNAMETXT"] = "Fill in a title!";
            }else if(strlen($title) > 50){
                $Msg["errorNAMETXT"] = "The title has to be less than 50 characters!";
            }

            if(empty($privacy)){
                $Msg["errorPRIVACYTXT"] = "Please select a privacy setting!";
            }

            if(empty($des)){
                $Msg["errorDESTXT"] = "You must set a description for SEO purposes.";
            }else if(strlen($des) > 160){
                $Msg["errorDESTXT"] = "The description must be under 160 characters!";
            }

             
            // ([a-zA-Z0-9]*)(\/)([a-zA-Z0-9]]*)
            if(empty($slug)){
                $Msg["errorSLGTXT"] = "The page must have a custom slug so users can navigate to it!";
            }else if(preg_match('/\s/',$slug)){
                $Msg["errorSLGTXT"] = "The slug must not contain spaces!";
            }

            if(empty($content)){
                $Msg["errorCONTXT"] = "The page has to have some content!";
            }

    if ($Msg['basics'] && $Msg["errorCONTXT"] == null && $Msg["errorSLGTXT"] == null &&  $Msg["errorDESTXT"] == null && $Msg["errorPRIVACYTXT"] == null && $Msg["errorNAMETXT"] == null){
        
        
        $newslug = str_replace(" ", "", $slug);
    
        
        SQLWrapper()->prepare("UPDATE content SET content= :content,  created = :created, privacy = :privacy,title = :title,slug = :slug,description = :description WHERE thing = :thing")->execute([':content' => $content, ':created' => $changedby, ':thing' => $thing, ':privacy' => $privacy, ':title' => $title, 'description' => $des, 'slug' => $newslug]);
            $Msg['success'] = true;
            $Msg['message'] = "Changes saved! <b>It is now safe to navigate away from the page.</b>";
        }


        } else {
            $Msg["SysError"] = true;
            $Msg["message"] = "Unauthorized";
        }
    } else {
    $Msg["SysError"] = true;
    $Msg["message"] = "Not logged in";
    }
    die(json_encode($Msg));
}
