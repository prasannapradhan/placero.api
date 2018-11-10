<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	if(isset($_POST['area'])){
		$area = $_POST['area'];
		$areaObj = json_decode($area);
	}else {
		$jsonInput = file_get_contents("php://input");
		$inputObj = json_decode($jsonInput);
		$areaObj = $inputObj->area;
	}
	
	$address_text = '';
	$aaTags = array();
	if(property_exists($areaObj, 'address')){
		$areaAddress = $areaObj->address;
		$address_text = $areaAddress->storable;
		$aaTags = $areaAddress->tags;
	}
	
	$areaMeasure = $areaObj->measure;
	$areaCenter = $areaObj->centerPosition;
	$areaPermissions = $areaObj->permissions;
	
	$area_insert_sql = "insert into area (id,deviceID,center_lon,center_lat,description,name,createdBy,msqft,address,type) 
		values('$areaObj->id','','$areaCenter->lng','$areaCenter->lat','$areaObj->description','$areaObj->name',
		'$areaObj->createdBy','$areaMeasure->sqFeet','$address_text','$areaObj->type')";
	error_log($area_insert_sql);
	mysql_query ($area_insert_sql);
	
	foreach ($areaPermissions as $permission) {
		$area_share_insert_sql = "insert into area_share (source_user,area_id,function_codes) 
			values ('$permission->userId','$permission->areaId','$permission->functionCode')";
		error_log($area_share_insert_sql);
		mysql_query($area_share_insert_sql);
	}
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area created successfully';
	$resp ['ret_obj'] = $areaObj;
	
	echo json_encode($resp);
?>