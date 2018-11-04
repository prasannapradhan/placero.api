<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$userObj = json_decode($_POST['user']);
	
	$user_check_qry = "SELECT * from user_master where email='$userObj->email'";
	$chk_result = mysql_query($user_check_qry);
	$num_rows = mysql_num_rows($chk_result);
	
	if($num_rows == 0){
		$query = "insert into user_master (displayName, email , familyName , givenName , photoUrl , authSystemId , deviceID )
				  VALUES ('$userObj->displayName','$userObj->email','$userObj->familyName','$userObj->givenName','$userObj->photoUrl',
				  '$userObj->authSystemId','')";
		
		error_log($query);
		mysql_query ($query);
		
		$user_id = mysql_insert_id();
		$userObj->id = $user_id;
	}else {
		$userObj = mysql_fetch_object($chk_result);
	}
	
	$resp = array();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'User created successfully';
	$resp ['data'] = $userObj;
	
	echo json_encode($resp);
?>