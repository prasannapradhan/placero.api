<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$area = $_POST ['area'];
	$areaObj = json_decode ( $area );
	$areaArr = ( array ) $areaObj;
	
	$area_id = $areaArr ['id'];
	$area_name = $areaArr ['name'];
	$area_desc = $placeArr ['description'];
	$area_clat = $placeArr ['c_lat'];
	$area_clng = $placeArr ['c_lng'];
	$area_sqft = $placeArr ['sq_ft'];
	$area_add = $placeArr ['address'];
	
	$area_update_sql = "update area_master set name='$area_name', desc='$area_desc', c_lat='$area_clat', 
		c_lng='$area_clng', sq_ft='$area_sqft', address='$area_add' where id=$area_id";
	mysql_query($area_update_sql);
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area updated successfully';
	$resp ['ret_obj'] = $area;
?>