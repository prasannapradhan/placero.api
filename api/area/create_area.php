<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$area = $_POST ['area'];
	$areaObj = json_decode ( $area );
	$areaArr = ( array ) $areaObj;
	
	$area_name = $areaArr ['name'];
	$area_desc = $placeArr ['description'];
	$area_clat = $placeArr ['c_lat'];
	$area_clng = $placeArr ['c_lng'];
	$area_sqft = $placeArr ['sq_ft'];
	$area_add = $placeArr ['address'];
	
	$area_insert_sql = "INSERT INTO area_master (name, desc, c_lat, c_lng, sq_ft, address) 
			VALUES ('$area_name', '$area_desc', '$area_clat', '$area_clng', '$area_sqft', '$area_add' )";
	mysql_query ($area_insert_sql);

	$area_id = mysql_insert_id();
	$area['id'] = $area_id;

	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area created successfully';
	$resp ['ret_obj'] = $area;
?>