<?php

require_once(dirname(__FILE__)."/include/include.php");


$sponsorId = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();


$ret = $db->dbSelect("payments", "sponsor_id=".(int)$sponsorId);
$res = array();
foreach($ret as $mem){
	$newRow = array(
	    "<span class='center'> <input type='checkbox' value={$mem['id']} name='selected_ids[]'/> </span>",
	    $mem["date"],
	    $mem["amount"]." USD",
	    $mem["card"],
	    $mem["plan"]." Members",
	);
	$res[]= $newRow;
}
header('Content-Type: application/json');
$ret = arrayPHPToJS($res);
echo '{"sEcho":"2","iTotalRecords":'.getMembersCount().',"iTotalDisplayRecords":'.getMembersCount().',"aaData":  '.$ret.'}';
