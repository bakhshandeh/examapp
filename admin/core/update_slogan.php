<?php

require_once(dirname(__FILE__)."/include/include.php");
$db = DBSingleton::getInstance();


$fs = array(
    "slogan",
);

$sponsorId = $_SESSION["loginInfo"]["id"];
$db=DBSingleton::getInstance();

try{
    /*
    if(strlen($_FILES["profile_img"]["name"]) && $_FILES["profile_img"]["error"]!=0){
	throw new Exception("Can not upload file!");
    }elseif(strlen($_FILES["profile_img"]["name"])){
	$fileName = rand(0, 1000000000)."_".$_FILES["profile_img"]["name"];
	saveImage($fileName, $_FILES["profile_img"]["tmp_name"]);
	$_POST["profile_img"] = $fileName;
	$fs[] = "profile_img";
    }*/
    
    foreach($fs as $f){
	$query = "INSERT into sponsors_data VALUES(" . $sponsorId . ", " . quote($f) . ", " . quote($_POST[$f]) . ") ON DUPLICATE KEY UPDATE value=" . quote($_POST[$f]) . "";

	if (!$db->query($query) ) {
	    throw new Exception("Query Failed!");
	}else{
	    //print "Your profile updated Successfully!";
	}
    }
    print "Home page slogan updated Successfully!";
}catch(Exception $e){
    //$_SESSION["error"] = "ERROR: ".$e->getMessage();
    print "ERROR: ".$e->getMessage();
}

$data = loadSponsor($_SESSION["loginInfo"]["id"]);
$_SESSION["loginInfo"] = $data;

?>
