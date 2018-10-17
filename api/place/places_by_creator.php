<?php
	header("Access-Control-Allow-Origin: *");
	include($_SERVER["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$uid = $_GET['uid'];
	$place_fetch_sql = "select * from place_master where owned_by=$uid";
	
	$result = mysql_query($place_fetch_sql);
	$records = array();
	while ($row = mysql_fetch_object($result)) {
		$records[] = $row;
	}
	mysql_free_result($result);
	
	$resp = array();
	$resp['status_code'] = 'SUCCESS';
	$resp['status_msg'] = 'Place removed successfully';
	$resp['ret_obj'] = $records;
?>