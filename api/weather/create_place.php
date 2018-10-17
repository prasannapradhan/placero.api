<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$place = $_POST['place'];
	$placeObj = json_decode($place);
	$placeArr = (array) $placeObj;
	
	$place_name = $placeArr['name'];
	$place_desc = $placeArr['description'];
	$place_cb = $placeArr['created_by'];
	
	$place_insert_sql = "INSERT INTO place_master (name, desc, created_by) VALUES('$place_name', '$place_desc', $place_cb)";
	mysql_query($place_insert_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Place created successfully';
	$resp['ret_obj'] = $place;
?>