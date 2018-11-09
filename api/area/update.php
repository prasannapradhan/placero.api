<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	if(isset($_POST['area'])){
		$area = $_POST['area'];
		$areaObj = json_decode($area);
	}else {
		$jsonInput = file_get_contents("php://input");
		$areaObj = json_decode($jsonInput);
	}
	
	$areaAddress = $areaObj->address;
	$aaTags = $areaAddress->tags;
	$areaMeasure = $areaObj->measure;
	$areaCenter = $areaObj->centerPosition;

	$area_update_sql = "update area SET center_lon='$areaCenter->lng', center_lat='$areaCenter->lat',description='$areaObj->description',
		name='$areaObj->name',msqft='$areaMeasure->sqFeet',address='$areaAddress->storable' where id='$areaObj->id'";
	error_log($area_update_sql);
	mysql_query($area_update_sql);
	
	$area_tag_rem_sql = "DELETE FROM tag_master where context_id='$areaObj->id'";
	mysql_query($area_tag_rem_sql);
	
	$millitime = round(microtime(true) * 1000);
	foreach ($aaTags as $tag) {
		$area_tag_ins_sql = "INSERT INTO tag_master (name, type, type_field, context, context_id, created_on) 
							 VALUES ('$tag->name', '$tag->type', '$tag->typeField', 'area', '$areaObj->id', '$millitime')";
		mysql_query($area_tag_ins_sql);
	}
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area updated successfully';
	$resp ['ret_obj'] = $area;
	
	echo json_encode($resp);
?>