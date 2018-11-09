<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	if(isset($_POST['media'])){
		$media = $_POST['media'];
		$mediaObj = json_decode($media);
	}else {
		$jsonInput = file_get_contents("php://input");
		$inputObj = json_decode($jsonInput);
		$mediaObj = $inputObj->area;
	}
	
	$media_insert_sql = "insert into place_media (id, place_ref, name, type, tf_name, tf_path, rf_name, rf_path, lat, lng) 
		values('$mediaObj->id', '$mediaObj->placeRef','$mediaObj->name','$mediaObj->type','$mediaObj->tfName','$mediaObj->tfPath',
		'$mediaObj->rfName','$mediaObj->rfPath','$mediaObj->lat','$mediaObj->lng')";
	
	mysql_query ($media_insert_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Media created successfully';
	$resp ['ret_obj'] = $mediaObj;
	
	echo json_encode($resp);
?>