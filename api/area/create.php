<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$area = $_POST['area'];
	$areaObj = json_decode($area);
	
	$areaAddress = $areaObj->address;
	$areaMeasure = $areaObj->measure;
	$areaCenter = $areaObj->centerPosition;
	$areaPermissions = $areaObj->permissions;
	
	$area_insert_sql = "insert into area (id,deviceID,center_lon,center_lat,description,name,createdBy,msqft,address,type) 
		values('$areaObj->id','','$areaCenter->lng','$areaCenter->lat','$areaObj->description','$areaObj->name',
		'$areaObj->createdBy','$areaMeasure->sqFeet','$areaAddress->storable','$areaObj->type')";
	mysql_query ($area_insert_sql);
	
	foreach ($areaPermissions as $permission) {
		$area_share_insert_sql = "insert into area_share (source_user,area_id,function_codes) 
			values ('$permission->userId','$permission->areaId','$permission->functionCode')";
		mysql_query($area_share_insert_sql);
	}
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area created successfully';
	$resp ['ret_obj'] = $area;
	
	echo json_encode($resp);
?>