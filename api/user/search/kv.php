<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");

	$ss = $_GET["ss"];
	$sf = $_GET ["sf"];
	
	$query = "select * from  user_master where $sf='$ss'";
	$result = mysql_query($query);
	
	$user_arr = array();
	while ($user_row = mysql_fetch_object($result)) {
		array_push($user_arr, $user_row);
	}
	echo json_encode($user_arr);
?>