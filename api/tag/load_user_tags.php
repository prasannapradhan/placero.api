<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$userObj = json_decode($_POST['user']);
	
	$user_tag_qry = "SELECT * from tag_master where context='user' and context_id='$userObj->email'";
	$user_tag_result = mysql_query($user_tag_qry);

	$user_tags = array();
	while($user_tag_row = mysql_fetch_object($user_tag_result)){
		array_push($user_tags, $user_tag_row);	
	}
	
	$resp = array();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'User tags fetched successfully';
	$resp ['data'] = $user_tags;
	
	echo json_encode($resp);
?>