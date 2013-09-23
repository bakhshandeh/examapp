<?php

require_once(dirname(__FILE__)."/include/include.php");
$spId = $_SESSION["loginInfo"]["id"];
$db=DBSingleton::getInstance();

$fs = array(
    "is_closed" => "1",
    "closed_date" => date("Y-m-d H:i:s"),
);

try{
    foreach($fs as $k => $f){
	$query = "INSERT into sponsors_data VALUES(" . $spId . ", " . quote($k) . ", " . quote($f) . ") ON DUPLICATE KEY UPDATE value=" . quote($f) . "";
        print $query;
	if (!$db->query($query) ) {
	    throw new Exception("Query Failed!");
	}else{
	    //print "Your profile updated Successfully!";
	}
    }
}catch(Exception $e){
    print "ERROR: ".$e->getMessage();
}

unset($_SESSION["loginInfo"]);

?>
