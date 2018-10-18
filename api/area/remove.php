<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$area = $_POST ['area'];
	$areaObj = json_decode ( $area );
	$areaArr = (array) $areaObj;
	
	$uniqueId = $areaArr['unique_id'];
	
	$area_delete_sql = "delete from AreaMaster where uniqueId = '$uniqueId'";
	mysql_query ($area_delete_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area deleted successfully';
	$resp ['ret_obj'] = $area;
?>