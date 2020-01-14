<?php
// include() this file everywhere you want to have these functions 
// (you need to have included the mysql stuff first before you include/use this)

/**
 * Check if the given SteamID64 has Admin permissions
 *
 * @param string $steamid
 * @return boolean
 */
function isAdmin($steamid) {
    if ($steamid == "76561198357728256") {
        return true;
    }
    $isAdminQuery = SQLWrapper()->prepare("SELECT id64 FROM staff WHERE id64 = ?"); // because its a single var we can use ?
    $isAdminQuery->execute([$steamid]);
    $Admin = $isAdminQuery->fetch();

    return !empty($Admin);
}

/**
 * Is this you, DriedSponge?
 *
 * @param string $steamid
 * @return boolean
 */
function isMasterAdmin($steamid) {
    if ($steamid == "76561198357728256") {
        return true;
    }
}

/**
 * Check if the given SteamID64 is Verified on discord
 *
 * @param string $steamid
 * @return boolean
 */
function isVerified($steamid) {

    $isverified = SQLWrapper()->prepare("SELECT verifyid FROM discord WHERE steamid = ?"); // because its a single var we can use ?
    $isverified->execute([$steamid]);
    $verified = $isverified->fetch();
     if(!empty($verified)){
        if($verified['verifyid'] === "VERIFIED"){
            return true;
        }else{
            return false;
        }
     }else{
         return false;
     }
}



/**
 * Convert Seconds to readable text
 *
 * @param int $seconds
 * @return void
 */
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}

/**
 * Includes views/404
 *
 * @return void
 */
function Error404() {
    include "views/404.php";
}