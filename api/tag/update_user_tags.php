<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$userObj = json_decode($_POST['user']);
	$tag_objs = json_decode($_POST['tags']);
	
	$user_tag_rem_qry = "DELETE from tag_master where context='user' and context_id='$userObj->email'";
	mysql_query($user_tag_rem_qry);

	foreach ($tag_objs as $tagObj) {
		$tag_insert_sql = "INSERT INTO tag_master (name, type, type_field, context, context_id, created_on)
						   VALUES('$tagObj->name', '$tagObj->type', '$tagObj->typeField', '$tagObj->context', 
					       '$tagObj->contextId', '$tagObj->createdOn')";
		mysql_query($tag_insert_sql);
	}
?>