<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$areaObj = json_decode($_POST['area']);
	$suserObj = json_decode($_POST['suser']);
	$tuserObj = json_decode($_POST['tuser']);
	$functions = $_POST['functions'];
	
	$query = "insert into AreaShare (source_user, target_user , area_id , function_codes) 
			  VALUES ('$suserObj->email','$tuserObj->email','$areaObj->id','$functions')";
	mysql_query ($query);
?>
