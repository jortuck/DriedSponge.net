<?php
header('Content-type: application/json');


if(isset($_POST['loadusr'])){
    $Message = array(
        "success" => false,
        "message" => "Something went wrong I guess"
    );
    if(isset($_SESSION['steamid'])){
        if(isAdmin($_SESSION['steamid'])){
            
            $Message['success'] = true;
            $Message['message'] = $unblockid." has been unblocked!";
      }else{
          $Message["message"] = "You're not an admin";
      }
      }else{
          $Message["message"] = "You're not logged in";
      }
    die(json_encode($Message));
}


if(isset($_POST['unblockusr'])){
    $Message = array(
        "success" => false,
        "message" => "Something went wrong I guess"
    );
    if(isset($_SESSION['steamid'])){
        if(isAdmin($_SESSION['steamid'])){
            
            $unblockid = $_POST['id64'];
            $sqlunblock = SQLWrapper()->prepare("DELETE FROM blocked WHERE id64= :id");
            $sqlunblock->execute([':id' => $unblockid]);
            $Message['success'] = true;
            $Message['message'] = $unblockid." has been unblocked!";
      }else{
          $Message["message"] = "You're not an admin";
      }
      }else{
          $Message["message"] = "You're not logged in";
      }
    die(json_encode($Message));
}




if(isset($_POST['blockusr'])){
    $Message = array(
        "success" => false,
        "SysError" => false,
        "basics" => false,
        "errorID64" => false,
        "errorRSN" => false,
        "errorID64TXT" => null,
        "errorRSNTXT" => null,
        "message" => "Something went wrong I guess"
    );
    if(isset($_SESSION['steamid'])){
      if(isAdmin($_SESSION['steamid'])){
        $Message["basics"] = true;
        $admin = $_SESSION['steamid'];
        $blockid = $_POST['id64'];
        $blockrsn =$_POST['rsn'];

        if(empty($blockid)){
            $Message['errorID64'] = true;
            $Message['errorID64TXT'] = "You must specify which user to block!";

        }else if(!is_numeric($blockid)){
            $Message['errorID64'] = true;
            $Message['errorID64TXT'] = "SteamID64's are numbers only!";
        }else if(is_numeric($blockid) && !empty($blockid)){
            $Message['errorID64'] = false;
        }
        if(empty($blockrsn)){
            $Message['errorRSN'] = true;
            $Message['errorRSNTXT'] = "You must specify a valid reson!";

        }else if(strlen($blockrsn) > 100){
            $Message['errorRSN'] = true;
            $Message['errorRSNTXT'] = "The reason must be under 100 characters";
        }else if(strlen($blockrsn) < 100 && !empty($blockrsn)){
            $Message['errorRSN'] = false;
        }
        if($Message["basics"] && !$Message["errorRSN"] && !$Message['errorID64']){  
        $blockstamp = time();
        $sqlblockexistquery = SQLWrapper()->prepare("SELECT id64 FROM blocked WHERE id64= :id");
        $sqlblockexistquery->execute([':id' => $blockid]);
        $blockrows = $sqlblockexistquery->fetch();
            if (!empty($blockrows)){
                $Message["SysError"] = true;
                $Message['message'] = "This user is already blocked!";        
             } else{
                 $sqlblock = SQLWrapper()->prepare("INSERT INTO blocked (id64, rsn, stamp)
                 VALUES (?,?,?)")->execute([$blockid,  $blockrsn,$blockstamp]);
                 $Message['blockdate'] =  date("m/d/Y g:i a", $blockstamp);
                 $Message["success"] = true;
                 $Message['message'] = $blockid." has been blocked";

        }
    }
    }else{
        $Message["SysError"] = true;
        $Message["message"] = "You're not an admin";
    }
    }else{
        $Message["SysError"] = true;
        $Message["message"] = "You're not logged in";
    }
    die(json_encode($Message));
}