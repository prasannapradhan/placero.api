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

	$area_update_sql = "update AreaMaster SET center_lon='$areaCenter->lng',
		center_lat='$areaCenter->lat',description='$areaObj->description',name='$areaObj->name',msqft='$areaMeasure->sqFeet',
		address='$areaAddress->storable' where uniqueId='$areaObj->uniqueId'";
	mysql_query($area_update_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area updated successfully';
	$resp ['ret_obj'] = $area;
?>