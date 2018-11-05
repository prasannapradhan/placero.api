<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$us = $_GET["us"];
	$area_share_qry = "select * from AreaShare where target_user='$us'";
	$result = mysql_query($area_share_qry);
	
	$area_records = array();
	while ($row = mysql_fetch_object($result)) {
		$area_id = $row->area_id;
		$area_record = array();
		
		$area_qry = "select * from area where id='$area_id'";
		error_log("Area detail query [$area_qry]");
		$area_result = mysql_query($area_qry);
		$area_record['detail'] = mysql_fetch_object($area_result);
		$area_record['permission'] = $row;
		mysql_free_result($area_result);
		
		$positions_qry = "select * from position where area_ref='$area_id'";
		$positions_result = mysql_query($positions_qry);
		$positions_arr = array();
		while ($position_row = mysql_fetch_object($positions_result)) {
			$positions_arr[] = $position_row;
		}
		$area_record['positions'] = $positions_arr;
		mysql_free_result($positions_result);
		
		$resources_qry = "select * from place_media where place_ref ='$area_id'";
		$resources_result = mysql_query($resources_qry);
		$resources_arr = array();
		while ($resource_row = mysql_fetch_object($resources_result)) {
			$resources_arr[] = $resource_row;
		}
		mysql_free_result($resources_result);
		$area_record['medias'] = $resources_arr;

		array_push($area_records, $area_record);
	}
	
	$resp = array ();
	$resp ['status_code'] = 'SUCCESS';
	$resp ['status_msg'] = 'User areas fetched successfully';
	$resp ['data'] = $area_records;
	
	echo json_encode($resp);
?>
