<?php
	require 'connection_init.php';
	// post extracts
	$device_id = isset ( $_POST ["device_id"] ) ? $_POST ["device_id"] : "";
	$queryType = isset ( $_POST ["query_type"] ) ? $_POST ["query_type"] : "";
	$area_id = isset ( $_POST ["area_id"] ) ? $_POST ["area_id"] : "";
	$user_id = isset ( $_POST ["user_id"] ) ? $_POST ["user_id"] : "";
	$unique_id = isset ( $_POST ["unique_id"] ) ? $_POST ["unique_id"] : "";
	$container_id = isset ( $_POST ["container_id"] ) ? $_POST ["container_id"] : "";
	$resource_id = isset ( $_POST ["resource_id"] ) ? $_POST ["resource_id"] : "";
	$name = isset ( $_POST ["name"] ) ? $_POST ["name"] : "";
	$type = isset ( $_POST ["type"] ) ? $_POST ["type"] : "";
	$content_type = isset ( $_POST ["content_type"] ) ? $_POST ["content_type"] : "";
	$mime_type = isset ( $_POST ["mime_type"] ) ? $_POST ["mime_type"] : "";
	$size = isset ( $_POST ["size"] ) ? $_POST ["size"] : "";
	$position_id = isset ( $_POST ["position_id"] ) ? $_POST ["position_id"] : "";
	$createdOn = isset ( $_POST ["created_on"] ) ? $_POST ["created_on"] : "";
	
	if ($queryType == 'insert') {
		$query = "insert into DriveMaster (deviceID, area_id , user_id , resource_id , container_id , name , type , content_type , mime_type , size , position_id , createdOn , unique_id) VALUES ('$device_id','$area_id','$user_id','$resource_id','$container_id','$name','$type','$content_type','$mime_type','$size','$position_id','$createdOn','$unique_id')";
		echo $query;
		mysqli_query ( $conn, $query );
		mysqli_error ( $conn );
		mysqli_close ( $conn );
	}
?>