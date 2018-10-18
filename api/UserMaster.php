<?php
	require 'connection_init.php';
	
	$display_name = isset ( $_POST ["display_name"] ) ? $_POST ["display_name"] : "";
	$email = isset ( $_POST ["email"] ) ? $_POST ["email"] : "";
	$familyName = isset ( $_POST ["family_name"] ) ?: "";
	$givenName = isset ( $_POST ["given_name"] ) ?: "";
	$photoUrl = isset ( $_POST ["photo_url"] ) ?: "";
	$systemId = isset ( $_POST ["auth_sys_id"] ) ?: "";
	$deviceID = isset ( $_POST ["deviceID"] ) ?: "";
	
	$query = "insert into user_master (displayName, email , familyName , givenName , photoUrl , authSystemId , deviceID ) VALUES ('$display_name','$email','$familyName','$givenName','$photoUrl','$systemId','$deviceID')";
	mysqli_query ( $conn, $query );
	mysqli_close ( $conn );
?>
