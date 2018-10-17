<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$resource = $_POST['resource'];
	$resObj = json_decode($resource);
	$resArr = (array) $resObj;
	
	$place_name = $resArr['name'];
	$place_desc = $resArr['type'];
	
	$place_insert_sql = "INSERT INTO place_master (name, desc, created_by) VALUES ('$place_name', '$place_desc', $place_cb)";
	mysql_query($place_insert_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Place created successfully';
	$resp['ret_obj'] = $place;
?>