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
	
	$media_delete_sql = "delete from place_media where id = '$mediaObj->id'";
	mysql_query ($media_delete_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Media deleted successfully';
	$resp ['ret_obj'] = $mediaObj;
	
	echo json_encode($resp);
?>