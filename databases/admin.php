<?php
include("connect.php");
function isadmin($isadminid){
$isadminidquery = $conn->prepare("SELECT id64 FROM staff WHERE id64 = :id");
$isadminidquery->execute([':id' => $isadminid]);
$isadmin = $isadminidquery->fetch();
if ($_SESSION['steamid'] == "76561198357728256" or !empty($isadmin)){ 

return true;

}else{
    return false;
}
}

?>