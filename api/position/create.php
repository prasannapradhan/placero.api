<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$position = $_POST['position'];
	$posObj = json_decode($position);
	$posArr = (array) $posObj;
	
	$id = $posArr['id'];
	$name = $posArr['name'];
	$desc = $posArr['description'];
	$lat = $posArr['lat'];
	$lng = $posArr['lng'];
	$address = $posArr['address'];
	
	$pos_insert_sql = "INSERT INTO position (id, name, desc, lat, lng, address) VALUES('$id', '$name', '$desc', '$lat', '$lng', '$address')";
	mysql_query($pos_insert_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Position created successfully';
	$resp['ret_obj'] = $position;
?>