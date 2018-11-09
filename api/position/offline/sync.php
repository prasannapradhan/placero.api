<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$positions = json_decode($_POST['positions']);
	foreach ($positions as $positionObj) {
		$dirty_action = $positionObj->dirtyAction;
		if($dirty_action == "insert"){
			// Call create api with the data
			error_log("Creating new offline position [$positionObj->id]");
			$url = 'http://api.placero.pearnode.com/api/position/create.php';
			$data = array('position' => $positionObj);
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$positionObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}else if($dirty_action == "update"){
			// Call update api with the data
			error_log("Updating offline position [$positionObj->id]");
			$url = 'http://api.placero.pearnode.com/api/position/update.php';
			$data = array('position' => $positionObj);
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$positionObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}else if($dirty_action == "remove"){
			// Call remove api with the data
			error_log("Removing offline position [$positionObj->id]");
			$url = 'http://api.placero.pearnode.com/api/position/remove.php';
			$data = array('position' => $positionObj);
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$positionObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}
	}
?>