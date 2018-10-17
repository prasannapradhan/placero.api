<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$area = $_POST ['area'];
	$areaObj = json_decode ( $area );
	$areaArr = (array) $areaObj;
	
	$area_id = $areaArr ['id'];
	$area_delete_sql = "delete from area_master where id=$area_id";
	mysql_query ($area_delete_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area deleted successfully';
	$resp ['ret_obj'] = $area;
?>