<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$media = $_POST['media'];
	$mediaObj = json_decode($media);
	
	$media_insert_sql = "insert into media (place_ref, name, type, tf_name, tf_path, rf_name, rf_path, lat, lng) 
		values('$mediaObj->placeRef','$mediaObj->name','$mediaObj->type','$mediaObj->tfName','$mediaObj->tfPath',
		'$mediaObj->rfName','$mediaObj->rfPath','$mediaObj->lat','$mediaObj->lng')";
	
	error_log($media_insert_sql);
	mysql_query ($media_insert_sql);
	
	$media_id = mysql_insert_id();
	$mediaObj->id = $media_id;
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Media created successfully';
	$resp ['ret_obj'] = $media;
	
	echo json_encode($resp);
?>