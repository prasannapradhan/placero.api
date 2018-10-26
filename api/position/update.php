<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$position = $_POST['position'];
	$posObj = json_decode($position);
	$posArr = (array) $posObj;
	
	$pos_id = $posArr['id'];
	$name = $posArr['name'];
	$desc = $posArr['description'];
	$lat = $posArr['lat'];
	$lng = $posArr['lng'];
	$address = $posArr['address'];
	
	$update_sql = "update position set name='$name', desc = '$desc', lat='$lat', lng='$lng', address='$address' where id='$pos_id'";
	mysql_query($update_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Position updated successfully';
	$resp['ret_obj'] = $position;
?>