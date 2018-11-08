<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$media = $_POST['media'];
	$positionObj = json_decode($media);
	
	$media_insert_sql = "insert into place_media (id, place_ref, name, type, tf_name, tf_path, rf_name, rf_path, lat, lng) 
		values('$positionObj->id', '$positionObj->placeRef','$positionObj->name','$positionObj->type','$positionObj->tfName','$positionObj->tfPath',
		'$positionObj->rfName','$positionObj->rfPath','$positionObj->lat','$positionObj->lng')";
	
	mysql_query ($media_insert_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Media created successfully';
	$resp ['ret_obj'] = $positionObj;
	
	echo json_encode($resp);
?>