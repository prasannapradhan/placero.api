<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$place = $_POST['place'];
	$placeObj = json_decode($place);
	$placeArr = (array) $placeObj;
	
	$place_id = $placeArr['id'];
	$place_name = $placeArr['name'];
	$place_desc = $placeArr['description'];
	$place_cb = $placeArr['created_by'];
	
	$place_remove_sql = "delete from place_master where id=$place_id";
	mysql_query($place_remove_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Place removed successfully';
	$resp['ret_obj'] = $place;
?>