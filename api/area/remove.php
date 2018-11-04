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
	
	$area_delete_sql = "delete from area where id= '$areaObj->id'";
	mysql_query ($area_delete_sql);
	
	$area_share_delete_sql = "delete from AreaShare where area_id= '$areaObj->id'";
	mysql_query ($area_share_delete_sql);

	$area_pos_delete_sql = "delete from position where area_ref= '$areaObj->id'";
	mysql_query ($area_pos_delete_sql);

	$area_media_delete_sql = "delete from place_media where place_ref= '$areaObj->id'";
	mysql_query ($area_media_delete_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area deleted successfully';
	$resp ['ret_obj'] = $area;
	
	echo json_encode($resp);
?>