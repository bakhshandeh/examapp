<?php

require_once(dirname(__FILE__)."/include/include.php");
$db = DBSingleton::getInstance();

$spId = (int)$_SESSION["loginInfo"]["id"];
$data = array(
    "send_date" => "now()",
    "subject" => quote($_REQUEST["subject"]),
    "body" => quote($_REQUEST["body"]),
    "sponsor_id" => $spId
);

if(isset($_FILES["attach"])){
    $f = $_FILES["attach"];
    if($f["error"] != 0){
	print "ERROR: Can not upload the file!";
	die();
    }
    
    $name = uploadFile($f);
    $data["attach"] = quote($name);
}

$db->dbInsert("notifs", $data);

$ret = $db->dbSelect("notifs", "", "", 0, -1, array("max(id) as max"));
$notifId = ((int)$ret[0]["max"]);

$ret = $db->dbSelect("members", "sponsor_id=".$spId);
foreach($ret as $mem){
    $d = array(
	    "member_id" => $mem["id"],
	    "notif_id" => $notifId,
	    "is_read" => 0
    );
    $db->dbInsert("notif_users", $d);
}
print "Your Notification saved successfully!";
?>
