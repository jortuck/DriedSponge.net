<?php
header('Content-type: application/json');
if(isset($_POST['getcache'])){
    $Message = array(
        "success" => false,
        "message" => "Something went wrong"
    );
    if(isset($_SESSION['steamid'])){
        if(isMasterAdmin($_SESSION['steamid'])){
            $cachedfiles = scandir("cache");
            $ignored = array('.', '..', '.svn', '.htaccess','.gitignore','.gitkeep'); 
            $totalcached = count($cachedfiles) - 4;	
            $Message["message"] = $totalcached;
            $Message["success"] = true;
        }else{
            $Message["message"] = "not authroized";
        }
    }else{
        $Message["message"] = "You're not logged in";
    }
    die(json_encode($Message));
}


if(isset($_POST['cc'])){
    $Message = array(
        "success" => false, 
        "message" => "Something went wrong I guess"
    );	
    if(isset($_SESSION['steamid'])){
        if(isMasterAdmin($_SESSION['steamid'])){

        
        $cachedfiles = scandir("cache");
        $ignored = array('.', '..', '.svn', '.htaccess','.gitignore','.gitkeep'); 
        $totalcached = count($cachedfiles) - 3;	  
        foreach ($cachedfiles as $deletefile){
            if (in_array($deletefile, $ignored)) continue;
            $filename = 'cache/'.$deletefile;
            unlink ($filename);
        
        }
        
            $Message["success"] = true;
            $Message["message"] = "The cache has been cleared!";
        
        }else{
            $Message["message"] = "Unauthorized";
        }
    }else{

        $Message["message"] = "Not logged in";
    }
    die(json_encode($Message));
}
