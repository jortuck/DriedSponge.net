<?php

if (isset($_POST['unverify'])) {
  header('Content-type: application/json');
  $Message = array(
    "success" => false,
    "message" => "Something went wrong"
  );
  if (isset($_SESSION['steamid'])) {
    if (isAdmin($_SESSION['steamid'])) {
      if(isVerified($_SESSION['steamid'])){

      $unverifyid = $_POST['discordid'];
      $username = $_POST['username'];
      $admininfo = SInfo($_SESSION['steamid']);
      $logdata = array(
        "User" => $admininfo,
        "Msg" => "<a href='/sprofile/" . $_SESSION['steamid'] . "/' target='_blank'>" . $steamprofile['personaname'] . "</a> unverified <strong>$username($unverifyid)</strong>"
      );
      if (AdminLog($logdata)) {
        try {
          $sql = SQLWrapper()->prepare("UPDATE discord SET verifyid = :vid WHERE discordid= :id");
          $sql->execute([':id' => $unverifyid, ':vid' => "UNVERIFIED"]);
          $Message = array(
            "success" => true,
            "message" => "$username has been unverified!"
          );
        } catch (PDOException $e) {
          SendError("MySQL Error", $e->getMessage());
          $Message["message"] = "There was an error saving the data! Try again later!";
        }
      } else {
        $Message["message"] = "There was an error logging the action, so it will not be performed! Try later!";
      }
    }else{
      $Message["message"] = "Ypu must be verified to unverify other users!";
    }
    } else {
      $Message["message"] = "Not an admin";
    }
  } else {
    $Message["message"] = "Session Expired";
  }
  die(json_encode($Message));
}

if (isset($_POST['verify'])) {
  header('Content-type: application/json');
  $Msg = array(
    "success" => false,
    "SysErr" => false,
    "Msg" => "Something went wrong!"
  );
  if (isset($_SESSION['steamid'])) {
    if (isAdmin($_SESSION['steamid'])) {
      if (isVerified($_SESSION['steamid'])) {
        $user = SInfo($_POST['steam']);
        if ($user['success'] == false) {
          $Msg["SteamErr"] = "The steam profile does not exist!";
        } else {
          $id64 = $user['id64'];

          if(isVerified($id64)){
            $Msg["SteamErr"] = "The user is already verified!";
            $Msg['SysErr'] = true;
            $Msg['Msg'] = "The user is already verified!";
          }

        }
        if (IsEmpty($_POST['discordtag'])) {
          $Msg["TagErr"] = "Please enter a discord user name and tag!";
        } else if (!preg_match("/.*#[0-9]{4}/", $_POST['discordtag'])) {
          $Msg["TagErr"] = "Please enter a properly formatted discord user name and tag! (DriedSponge#0001)";
        }
        if (IsEmpty($_POST['discordid'])) {
          $Msg['IDErr'] = "Please enter a Discord ID!";
        } else if (!is_numeric($_POST['discordid'])) {
          $Msg['IDErr'] = "Discord ID's are numbers only";
        }
        if (!isset($Msg['IDErr']) && !isset($Msg['TagErr']) && !isset($Msg['SteamErr'])) {
          $admininfo = SInfo($_SESSION['steamid']);
          $logdata = array(
            "User" => $admininfo,
            "Msg" => "<a href='/sprofile/" . $_SESSION['steamid'] . "/' target='_blank'>" . $steamprofile['personaname'] . "</a> verified <strong>".$user['name']."(".$_POST['discordtag'].")</strong>"
          );
          if (AdminLog($logdata)) {
            try {
              $sqlblock = SQLWrapper()->prepare("INSERT INTO discord (discordid,steamid, stamp, verifyid,discorduser,givenrole)
              VALUES (?,?,?,?,?,?)")->execute([$_POST['discordid'],$id64,time(),"VERIFIED",$_POST['discordtag'],0]);
              $Msg['success'] = true;
              $Msg['Msg'] = $user['name']." has been verified as ".$_POST['discordtag'];
            } catch (PDOException $e) {
              SendError("MySQL Error", $e->getMessage());
              $Message["Msg"] = "There was an error saving the data! Try again later!";
              $Msg['SysErr'] = true;
            }
          } else {
            $Msg['SysErr'] = true;
            $Message["Msg"] = "There was an error logging the action, so it will not be performed! Try later!";
          }
        }
      } else {
        $Msg['SysErr'] = true;
        $Msg['Msg'] = "You must be verified yourself to verify another user!";
      }
    } else {
      $Msg['SysErr'] = true;
      $Msg['Msg'] = "Session expired";
    }
  } else {
    $Msg['SysErr'] = true;
    $Msg['Msg'] = "Session expired";
  }
  die(json_encode($Msg));
}
