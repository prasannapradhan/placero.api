<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	if(isset($_POST['area'])){
		$media = $_POST['area'];
		$mediaObj = json_decode($media);
	}else {
		$jsonInput = file_get_contents("php://input");
		$inputObj = json_decode($jsonInput);
		$mediaObj = $inputObj->area;
	}
	
	$address_text = '';
	$aaTags = array();
	if(property_exists($mediaObj, 'address')){
		$areaAddress = $mediaObj->address;
		$address_text = $areaAddress->storable;
		$aaTags = $areaAddress->tags;
	}
	
	$areaMeasure = $mediaObj->measure;
	$areaCenter = $mediaObj->centerPosition;

	$area_update_sql = "update area SET center_lon='$areaCenter->lng', center_lat='$areaCenter->lat',description='$mediaObj->description',
		name='$mediaObj->name',msqft='$areaMeasure->sqFeet',address='$address_text' where id='$mediaObj->id'";
	error_log($area_update_sql);
	mysql_query($area_update_sql);
	
	$area_tag_rem_sql = "DELETE FROM tag_master where context_id='$mediaObj->id'";
	mysql_query($area_tag_rem_sql);
	
	$millitime = round(microtime(true) * 1000);
	foreach ($aaTags as $tag) {
		$area_tag_ins_sql = "INSERT INTO tag_master (name, type, type_field, context, context_id, created_on) 
							 VALUES ('$tag->name', '$tag->type', '$tag->typeField', 'area', '$mediaObj->id', '$millitime')";
		mysql_query($area_tag_ins_sql);
	}
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'Area updated successfully';
	$resp ['ret_obj'] = $mediaObj;
	
	echo json_encode($resp);
?>