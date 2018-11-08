<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$tag = $_POST['tag'];
	$tagObj = json_decode($tag);
	
	$tag_insert_sql = "INSERT INTO tag_master (name, type, type_field, context, context_id, created_on) 
		VALUES('$tagObj->name', '$tagObj->type', '$tagObj->typeField', '$tagObj->context', '$tagObj->contextId', '$tagObj->createdOn')";
	mysql_query($tag_insert_sql);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Tag created successfully';
	$resp['ret_obj'] = $tag;
	
	echo json_encode($resp);
?>