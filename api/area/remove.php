<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	if(isset($_POST['area'])){
		$media = $_POST['area'];
		$mediaObj = json_decode($media);
	}else {
		$jsonInput = file_get_contents("php://input");
		$inputObj = json_decode($jsonInput);
		$mediaObj = $inputObj->area;
	}
	
	$area_delete_sql = "delete from area where id= '$mediaObj->id'";
	mysql_query ($area_delete_sql);
	
	$area_share_delete_sql = "delete from area_share where area_id= '$mediaObj->id'";
	mysql_query ($area_share_delete_sql);

	$area_pos_delete_sql = "delete from position where area_ref= '$mediaObj->id'";
	mysql_query ($area_pos_delete_sql);

	$area_media_delete_sql = "delete from place_media where place_ref= '$mediaObj->id'";
	mysql_query ($area_media_delete_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area deleted successfully';
	$resp ['ret_obj'] = $media;
	
	echo json_encode($resp);
?>