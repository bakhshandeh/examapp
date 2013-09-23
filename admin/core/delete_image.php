<?php

require_once(dirname(__FILE__)."/include/include.php");
$db = DBSingleton::getInstance();
$spId = $_SESSION["loginInfo"]["id"];

$name = $_REQUEST["name"];
$db->dbDelete("sponsors_data", "sponsors_data.key=".quote($name)." and sponsor_id=".$spId);
?>
