<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$position = $_POST['position'];
	$posObj = json_decode($position);
	$posArr = (array) $posObj;
	
	$name = $posArr['name'];
	$desc = $posArr['description'];
	$lat = $posArr['lat'];
	$lng = $posArr['lng'];
	$address = $posArr['address'];
	
	$pos_insert_sql = "INSERT INTO position_master (name, desc, lat, lng, address) VALUES('$name', '$desc', '$lat', '$lng', '$address')";
	mysql_query($pos_insert_sql);
	
	$pos_id = mysql_insert_id();
	$position['id'] = $pos_id;
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Position created successfully';
	$resp['ret_obj'] = $position;
?>