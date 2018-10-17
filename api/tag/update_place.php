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
	
	$place_update_sql = "update place_master set name='$place_name', desc = '$place_desc', created_by=$place_cb where id=$place_id";
	mysql_query($place_update_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Place updated successfully';
	$resp['ret_obj'] = $place;
?>