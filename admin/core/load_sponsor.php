<?php

require_once(dirname(__FILE__)."/include/include.php");
$db = DBSingleton::getInstance();


$data = loadSponsor($_SESSION["loginInfo"]["id"]);
$_SESSION["loginInfo"] = $data;

$data2 = $data;
unset($data2["info"]);

print json_encode($data["info"]+$data2);
?>
