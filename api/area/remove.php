<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$area = $_POST['area'];
	$areaObj = json_decode($area);
	
	$areaAddress = $areaObj->address;
	$areaMeasure = $areaObj->measure;
	$areaCenter = $areaObj->centerPosition;
	$areaPositions = $areaObj->positions;
	$areaResources = $areaObj->resources;
	$areaPermissions = $areaObj->permissions;
	
	$area_delete_sql = "delete from AreaMaster where uniqueId = '$areaObj->uniqueId'";
	mysql_query ($area_delete_sql);
	
	// TODO Cascade delete other elements.
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area deleted successfully';
	$resp ['ret_obj'] = $area;
?>