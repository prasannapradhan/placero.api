<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	if(isset($_POST['position'])){
		$position = $_POST['position'];
		$posObj = json_decode($position);
	}else {
		$jsonInput = file_get_contents("php://input");
		$inputObj = json_decode($jsonInput);
		$posObj = $inputObj->area;
	}
	
	$pos_insert_sql = "INSERT INTO position (id, area_ref, device_id, name, description, lat, lng, tags, type, created_on) 
		VALUES('$posObj->id', '$posObj->areaRef', '', '$posObj->name', '$posObj->description', $posObj->lat, $posObj->lng, 
		'$posObj->tags', '$posObj->type', '$posObj->createdOn')";
	mysql_query($pos_insert_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Position created successfully';
	$resp['ret_obj'] = $position;
	
	echo json_encode($resp);
?>