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
	
	$areaArr = (array) $areaObj;
	
	$area_insert_sql = "insert into AreaMaster (deviceID,center_lon,center_lat,description,name,createdBy,uniqueId,msqft,address,type) 
		values('','$areaCenter->lng','$areaCenter->lat','$areaObj->description','$areaObj->name',
		'$areaObj->createdBy','$areaObj->uniqueId','$areaMeasure->sqFeet','$areaAddress->storable','$areaObj->type')";
	error_log($area_insert_sql);
	mysql_query ($area_insert_sql);
	
	foreach ($areaPermissions as $permission) {
		$area_share_insert_sql = "insert into AreaShare (source_user,area_id,function_codes) 
			values ('$permission->userId','$permission->areaId','$permission->functionCode')";
		mysql_query($area_share_insert_sql);
	}
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area created successfully';
	$resp ['ret_obj'] = $area;
?>