<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$media = $_POST['media'];
	$positionObj = json_decode($media);
	
	$media_delete_sql = "delete from place_media where id = '$positionObj->id'";
	mysql_query ($media_delete_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Media deleted successfully';
	$resp ['ret_obj'] = $positionObj;
	
	echo json_encode($resp);
?>