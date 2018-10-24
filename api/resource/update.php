<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$media = $_POST['media'];
	$mediaObj = json_decode($media);
	
	$media_update_sql = "update media set place_ref='$mediaObj->placeRef',name='$mediaObj->tfName',type='$mediaObj->type',
		tf_name='$mediaObj->name',tf_path='$mediaObj->tfPath',rf_name='$mediaObj->rfName',rf_path='$mediaObj->rfPath',
		lat='$mediaObj->lat',lng='$mediaObj->lng' where id=$mediaObj->id"; 
	mysql_query($media_update_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Media updated successfully';
	$resp ['ret_obj'] = $media;
	
	echo json_encode($resp);
?>