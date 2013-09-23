<?php

require_once(dirname(__FILE__)."/../include.php");

$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();


$rets = $db->dbSelect("students", "", 0, -1, "", array("id", "email", "name", "city", "area", "country", "mobile"));

header('Content-Type: application/json');
$ret = arrayPHPToJS($rets);
echo '{"sEcho":"2","iTotalRecords":'.count($rets).',"iTotalDisplayRecords":'.count($rets).',"aaData":  '.$ret.'}';
