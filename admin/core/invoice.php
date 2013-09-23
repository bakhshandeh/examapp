<?php

require_once(dirname(__FILE__)."/include/include.php");

function loadInvoice(){
    $sponsorId = $_SESSION["loginInfo"]["id"];
    $db = DBSingleton::getInstance();

    $ids = $_REQUEST["selected_ids"];
    $id = $ids[0];

    $ret = $db->dbSelect("payments", "sponsor_id=".(int)$sponsorId." and id=".(int)$id);
    return $ret[0];
}
