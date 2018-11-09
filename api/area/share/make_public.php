<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$areaObj = json_decode($_POST['area']);
	$userObj = json_decode($_POST['user']);
	
	$query = "INSERT INTO area_share (source_user, target_user, area_id, function_codes) 
			  VALUES ('$userObj->email', 'any', '$areaObj->id', 'view_only')";
	mysql_query($query);
?>