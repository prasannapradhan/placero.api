<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$us = isset ( $_GET ["us"] ) ? $_GET ["us"] : "";
	$uniqueAreaQuery = "select distinct(area_id) from AreaShare where source_user = '$us' or target_user = '$us'";
	
	$uniqueAreaIdResult = mysqli_query ( $conn, $uniqueAreaQuery );
	$areaIds = array ();
	$uniqueAreaIdCount = mysqli_num_rows ( $uniqueAreaIdResult );
	$ctr = 0;
	if ($uniqueAreaIdCount > 0) {
		// output data of each row
		while ( $uniqueAreaIdRow = mysqli_fetch_assoc ( $uniqueAreaIdResult ) ) {
			$areaIds [$ctr] = $uniqueAreaIdRow ["area_id"];
			$ctr += 1;
		}
	}
	
	$user_result = "[";
	$i = 0;
	
	$arrLength = count ( $areaIds );
	for($x = 0; $x < $arrLength; $x ++) {
		$query = "select * from  AreaMaster  where uniqueId ='$areaIds[$x]'";
		$areaSharequery = "select * from AreaShare where (source_user = '$us' or target_user = '$us')  AND area_id = '$areaIds[$x]'";
		$result = mysqli_query ( $conn, $query );
		if (mysqli_num_rows ( $result ) > 0) {
			// output data of each row
			while ( $row = mysqli_fetch_assoc ( $result ) ) {
				if ($i > 0) {
					$user_result .= ",";
				}
				$user_result .= "{\"area\":{\"type\":\"" . $row ["type"] . "\",\"id\":\"" . $row ["id"] . "\",\"center_lon\":\"" . $row ["center_lon"] . "\",\"center_lat\":\"" . $row ["center_lat"] . "\",\"description\":\"" . $row ["description"] . "\",\"name\":\"" . $row ["name"] . "\",\"created_by\":\"" . $row ["createdBy"] . "\",\"unique_id\":\"" . $row ["uniqueId"] . "\",\"deviceID\":\"" . $row ["deviceID"] . "\",\"measure_sqft\":\"" . $row ["msqft"] . "\",\"address\":\"" . $row ["address"] . "\"}";
				$dRSQuery = "select * from DriveMaster where area_id = \"" . $row ["uniqueId"] . "\"";
				$k = 0;
				$drs_result = mysqli_query ( $conn, $dRSQuery );
				$user_result .= ",\"drs\":[";
				if (mysqli_num_rows ( $drs_result ) > 0) {
					while ( $drsRow = mysqli_fetch_assoc ( $drs_result ) ) {
						if ($k > 0) {
							$user_result .= ",";
						}
						$user_result .= "{\"unique_id\":\"" . $drsRow ["unique_id"] . "\",\"area_id\":\"" . $drsRow ["area_id"] . "\",\"user_id\":\"" . $drsRow ["user_id"] . "\",\"container_id\":\"" . $drsRow ["container_id"] . "\",\"resource_id\":\"" . $drsRow ["resource_id"] . "\",\"name\":\"" . $drsRow ["name"] . "\",\"type\":\"" . $drsRow ["type"] . "\",\"size\":\"" . $drsRow ["size"] . "\",\"mime_type\":\"" . $drsRow ["mime_type"] . "\",\"content_type\":\"" . $drsRow ["content_type"] . "\",\"position_id\":\"" . $drsRow ["position_id"] . "\",\"created_on\":\"" . $drsRow ["createdOn"] . "\"}";
						$k += 1;
					}
				}
				$user_result .= "]";
				
				// permission
				$j = 0;
				$shareResult = mysqli_query ( $conn, $areaSharequery );
				$user_result .= ",\"permissions\":[";
				if (mysqli_num_rows ( $shareResult ) > 0) {
					while ( $sRow = mysqli_fetch_assoc ( $shareResult ) ) {
						if ($j > 0) {
							$user_result .= ",";
						}
						$user_result .= "{\"user_id\":\"" . $sRow ["source_user"] . "\",\"area_id\":\"" . $sRow ["area_id"] . "\",\"function_code\":\"" . $sRow ["function_codes"] . "\"}";
						$j += 1;
					}
					$user_result .= "]";
				}
				$i += 1;
				
				// positions
				$p = 0;
				$user_result .= ",\"positions\":[";
				$positionQuery = "select * from PositionMaster where uniqueAreaId = \"" . $row ["uniqueId"] . "\"";
				// echo $positionQuery;
				$posResult = mysqli_query ( $conn, $positionQuery );
				if (mysqli_num_rows ( $posResult ) > 0) {
					while ( $posRow = mysqli_fetch_assoc ( $posResult ) ) {
						if ($p > 0) {
							$user_result .= ",";
						}
						$user_result .= "{\"unique_id\":\"" . $posRow ["uniqueId"] . "\",\"unique_area_id\":\"" . $posRow ["uniqueAreaId"] . "\",\"name\":\"" . $posRow ["name"] . "\",\"description\":\"" . $posRow ["description"] . "\",\"lat\":\"" . $posRow ["lat"] . "\",\"lon\":\"" . $posRow ["lon"] . "\",\"tags\":\"" . $posRow ["tags"] . "\",\"type\":\"" . $posRow ["type"] . "\",\"created_on\":\"" . $posRow ["createdOn"] . "\"}";
						$p += 1;
					}
				}
				$user_result .= "]";
				$user_result .= "}";
			}
		}
	} // End Of For Loop
	$user_result .= "]";
	echo "{\"area_response\":" . $user_result . ",\"common_response\":[]}";
?>
