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
	
	$update_sql = "update position set description='$posObj->description', tags='$posObj->tags', type='$posObj->type' where id='$posObj->id'";
	mysql_query($update_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Position updated successfully';
	$resp['ret_obj'] = $position;
	
	echo json_encode($resp);
?>