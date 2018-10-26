<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$media = $_POST['media'];
	$mediaObj = json_decode($media);
	
	$media_update_sql = "update place_media set name='$mediaObj->name' where id=$mediaObj->id"; 
	mysql_query($media_update_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Media updated successfully';
	$resp ['ret_obj'] = $mediaObj;
	
	echo json_encode($resp);
?>