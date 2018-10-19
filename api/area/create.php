<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$area = $_POST ['area'];
	$areaObj = json_decode ( $area );
	$areaArr = (array) $areaObj;
	
	$deviceID = $areaArr['deviceID'];
	$centerLong = $areaArr['center_lon'];
	$centerLat = $areaArr['center_lat'];
	$desc = $areaArr['desc'];
	$name = $areaArr['name'];
	$createdBy = $areaArr['created_by'];
	$uniqueId = $areaArr['unique_id'];
	$msqft = $areaArr['msqft'];
	$address = $areaArr['address'];
	$type = $areaArr['type'];
	
	$area_insert_sql = "insert into AreaMaster (deviceID,center_lon,center_lat,description,name,createdBy,uniqueId,msqft,address,type) 
		values('$deviceID','$centerLong','$centerLat','$desc','$name','$createdBy','$uniqueId','$msqft','$address','$type')";
	error_log($area_insert_sql);
	mysql_query ($area_insert_sql);
	
	$area_share_insert_sql = "insert into AreaShare (source_user,area_id,function_codes) values ('$createdBy','$uniqueId','full_control')";
	mysql_query($area_share_insert_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area created successfully';
	$resp ['ret_obj'] = $area;
?>