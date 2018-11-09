<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$areas = json_decode($_POST['areas']);
	$resp = array();
	foreach ($areas as $areaObj) {
		$dirty_action = $areaObj->dirtyAction;
		if($dirty_action == "create"){
			// Call create api with the data
			error_log("Creating new offline area [$areaObj->id]");
			$data = array('area' => $areaObj);
			$url = 'http://api.placero.pearnode.com/api/area/create.php';
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$areaObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}else if($dirty_action == "update"){
			// Call update api with the data
			error_log("Updating offline area [$areaObj->id]");
			$data = array('area' => $areaObj);
			$url = 'http://api.placero.pearnode.com/api/area/update.php';
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$areaObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}else if($dirty_action == "remove"){
			// Call remove api with the data
			error_log("Removing offline area [$areaObj->id]");
			$data = array('area' => $areaObj);
			$url = 'http://api.placero.pearnode.com/api/area/remove.php';
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$areaObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}
	}
	
	$result = array ();
	$result['status_code'] = 'SUCCESS';
	$result['status_msg'] = 'Sync performed successfully';
	$result['ret_obj'] = $resp;
	
?>