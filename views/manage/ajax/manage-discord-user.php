<?php

if (isset($_POST['unverify'])) {
  header('Content-type: application/json');
  $Message = array(
    "success" => false,
    "message" => "Something went wrong"
  );
  if (isset($_SESSION['steamid'])) {
    if (isAdmin($_SESSION['steamid'])) {
      $unverifyid = $_POST['discordid'];
      $username = $_POST['username'];
      $admininfo = SInfo($_SESSION['steamid']);
      $logdata = array(
        "User" => $admininfo,
        "Msg" => "<a href='/sprofile/" . $_SESSION['steamid'] . "/' target='_blank'>".$steamprofile['personaname']."</a> unverified <strong>$username($unverifyid)</strong>"
      );
      if (AdminLog($logdata)) {
        try {
          $sql = SQLWrapper()->prepare("UPDATE discord SET verifyid = :vid WHERE discordid= :id");
          $sql->execute([':id' => $unverifyid, ':vid' => "UNVERIFIED"]);
          $Message = array(
            "success" => true,
            "message" => "$username has been unverified!"
          );
        } catch (PDOException $e){
          SendError("MySQL Error", $e->getMessage());
          $Message["message"] = "There was an error saving the data! Try again later!";
        }
      }else{
        $Message["message"] = "There was an error logging the action, so it will not be performed! Try later!";
      }
    } else {
      $Message["message"] = "Not an admin";
    }
  } else {
    $Message["message"] = "Session Expired";
  }
  die(json_encode($Message));
}
