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

	$area_update_sql = "update AreaMaster SET deviceID = '$deviceID',center_lon='$centerLong',
		center_lat='$centerLat',description='$desc',name='$name',msqft='$msqft',address='$address' where uniqueId='$uniqueId'";
	mysql_query($area_update_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area updated successfully';
	$resp ['ret_obj'] = $area;
?>