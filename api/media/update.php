<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$media = $_POST['media'];
	$positionObj = json_decode($media);
	
	$media_update_sql = "update place_media set name='$positionObj->name' where id='$positionObj->id'"; 
	mysql_query($media_update_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Media updated successfully';
	$resp ['ret_obj'] = $positionObj;
	
	echo json_encode($resp);
?>