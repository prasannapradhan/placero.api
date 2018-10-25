<?php
	require 'connection_init.php';
	
	$requestType = isset ( $_POST ["requestType"] ) ? $_POST ["requestType"] : "1";
	$queryType = isset ( $_POST ["queryType"] ) ? $_POST ["queryType"] : "";
	$deviceID = isset ( $_POST ["deviceID"] ) ? $_POST ["deviceID"] : "";
	$centerLong = isset ( $_POST ["lon"] ) ? $_POST ["lon"] : "";
	$centerLat = isset ( $_POST ["lat"] ) ? $_POST ["lat"] : "";
	$desc = isset ( $_POST ["desc"] ) ? $_POST ["desc"] : "";
	$tags = isset ( $_POST ["tags"] ) ? $_POST ["tags"] : "";
	$name = isset ( $_POST ["name"] ) ? $_POST ["name"] : "";
	$type = isset ( $_POST ["type"] ) ? $_POST ["type"] : "";
	$createdOn = isset ( $_POST ["created_on"] ) ? $_POST ["created_on"] : "";

	$area_ref = isset ( $_POST ["area_ref"] ) ? $_POST ["area_ref"] : "";
	
	if ($queryType == 'insert') {
		$query = "insert into position (device_id , lon , lat , description , name , createdOn , area_ref , tags , type ) 
			values('$deviceID','$centerLong','$centerLat','$desc','$name','$createdOn','$area_ref','$tags','$type')";
	} else if ($queryType == 'update') {
		$query = "update position SET device_id = '$deviceID' , lon = '$centerLong' , lat = '$centerLat', 
		description = '$desc' , name = '$name' , area_ref = '$area_ref' , tags = '$tags' , type = '$type' where id = $id";
	} else if ($queryType == 'delete') {
		$query = "delete from position where id = $id";
	}
	
	echo $query;
	if (! mysqli_query($conn, $query)) {
		echo ("Error description: ". mysqli_error($conn));
	}
	
	mysqli_close ($conn);
?>
