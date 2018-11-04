<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$sk = "";
	if(isset($_GET['sk'])){
		$sk = $_GET['sk'];
	}
	
	$area_search_qry = "select a.*,ash.source_user from AreaShare ash 
						LEFT JOIN area a on ash.area_id=a.id 
					    where ash.target_user='any'";
	if($sk != ""){
		$area_search_qry = $area_search_qry." AND (a.name like '%$sk%' OR a.description like '%$sk%' OR a.address like '%sk%')";
	}
	$result = mysql_query($area_search_qry);
	
	$area_records = array();
	while ($row = mysql_fetch_object($result)) {
		$area_id = $row->area_id;
		$area_record = array();
		
		$area_record['detail'] = $row;
		
		$permission = array();
		$permission['user_id'] = $row->source_user;
		$permission['area_id'] = $row->id;
		$permission['function_code'] = 'any';
		$area_record['permission'] = $permission;
		
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
