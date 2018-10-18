<?php
	require 'connection_init.php';
	$ss = isset ( $_GET ["ss"] ) ? $_GET ["ss"] : "";
	$sf = isset ( $_GET ["sf"] ) ? $_GET ["sf"] : "";
	if ($ss == "" || $sf == "") {
		return "[]";
	}
	$query = "select * from  DriveMaster  where '$ss' ='$us'";
	$result = mysqli_query ( $conn, $query );
	$user_result = "[";
	$i = 0;
	if (mysqli_num_rows ( $result ) > 0) {
		// output data of each row
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			if ($i > 0) {
				$user_result .= ",";
			}
			$user_result .="{\"unique_id\":\"".$row['unique_id']."\",\"device_id\":\""$row ["deviceID"] . "\",\"area_id\":\"" . $row ["area_id"] . "\",\"user_id\":\"" . $row ["user_id"] . "\",\"resource_id\":\"" . row ["resource_id"] . "\",\"container_id\":\"" . $row ["container_id"] . "\"name\":\"" . $row ["name"] . "\",\"type\":\"" . $row ["type"] . "\",\"content_type\":\"" . $row ["content_type"] . "\",\"mime_type\":\"" . $row ["mime_type"] . "\",\"size\":\"" . $row ["size"] . "\",\"position_id\":\"" . $row ["position_id"] . "\",\"created_on\":\"" . $row ["createdOn"] . "\",\"unique_id\":\"" . $row ["unique_id"] . "\"}";
			$i += 1;
		}
	}
	$user_result .= "]";
	echo "{\"drs\":" . $user_result . "}";
?>
