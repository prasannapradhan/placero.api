<?php
	require 'connection_init.php';
	
	$requestType = isset ( $_POST ["requestType"] ) ? $_POST ["requestType"] : "1";
	$queryType = isset ( $_POST ["queryType"] ) ? $_POST ["queryType"] : "";
	$deviceID = isset ( $_POST ["deviceID"] ) ? $_POST ["deviceID"] : "";
	$centerLong = isset ( $_POST ["center_lon"] ) ? $_POST ["center_lon"] : "";
	$centerLat = isset ( $_POST ["center_lat"] ) ? $_POST ["center_lat"] : "";
	$desc = isset ( $_POST ["desc"] ) ? $_POST ["desc"] : "";
	$name = isset ( $_POST ["name"] ) ? $_POST ["name"] : "";
	$createdBy = isset ( $_POST ["created_by"] ) ? $_POST ["created_by"] : "";
	$uniqueId = isset ( $_POST ["unique_id"] ) ? $_POST ["unique_id"] : "";
	$msqft = isset ( $_POST ["msqft"] ) ? $_POST ["msqft"] : "";
	$address = isset ( $_POST ["address"] ) ? $_POST ["address"] : "";
	$type = isset ( $_POST ["type"] ) ? $_POST ["type"] : "self";
	if ($queryType == 'insert') {
		$query = "insert into AreaMaster (deviceID , center_lon , center_lat , description , name , createdBy , uniqueId , msqft , address , type) values('$deviceID','$centerLong','$centerLat','$desc','$name','$createdBy','$uniqueId','$msqft','$address','$type')";
		mysqli_query ( $conn, $query );
		mysqli_close ( $conn );
		
		$conns = mysqli_connect ( 'db.placero.pearnode.com', 'placero', 'placero', 'placerodb' );
		if (mysqli_connect_errno ()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error ();
		}
		$querys = "insert into AreaShare (source_user,area_id,function_codes) values ('$createdBy','$uniqueId','full_control')";
		mysqli_query ( $conns, $querys );
		mysqli_close ( $conns );
	} else if ($queryType == 'update') {
		$query = "update AreaMaster SET deviceID = '$deviceID' , center_lon = '$centerLong' , center_lat = '$centerLat', description = '$desc' , name = '$name' , msqft = '$msqft' , address = '$address' where uniqueId = '$uniqueId'";
		mysqli_query ( $conn, $query );
		mysqli_close ( $conn );
	} else if ($queryType == 'delete') {
		$query = "delete from AreaMaster where uniqueId = '$uniqueId'";
		mysqli_query ( $conn, $query );
		mysqli_close ( $conn );
	}
?>
