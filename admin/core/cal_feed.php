<?php

require_once(dirname(__FILE__)."/include/include.php");

$db = DBSingleton::getInstance();
$spId = $_SESSION["loginInfo"]["id"];

if(isset($_REQUEST["type"])){
    $start = strtotime($_REQUEST["start"]);
    $end = strtotime($_REQUEST["end"]);
    $allDay = $_REQUEST["allDay"] == "true" ? 1 : 0;
    
    $db->dbInsert("events", array(
	"start" => (int)$start,
	"end" => (int)$end,
	"allDay" => $allDay,
	"sponsor_id" => $spId,
	"title" => quote($_REQUEST["title"])
    ));
    print "OK";
    die();
}

$start = (int)$_REQUEST["start"];
$end = (int)$_REQUEST["end"];

$rets = $db->dbSelect("events", "start >= {$start} and start <= {$end} and sponsor_id={$spId}", "", 0, -1, array("start", "end", "allday", "title"));
print json_encode($rets);
?>
