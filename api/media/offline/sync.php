<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$medias = json_decode($_POST['medias']);
	foreach ($medias as $mediaObj) {
		$dirty_action = $mediaObj->dirtyAction;
		if($dirty_action == "create"){
			// Call create api with the data
			error_log("Creating new offline media [$mediaObj->id]");
			$url = 'http://api.placero.pearnode.com/api/media/create.php';
			$data = array('media' => $mediaObj);
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$mediaObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}else if($dirty_action == "update"){
			// Call update api with the data
			error_log("Updating offline media [$mediaObj->id]");
			$url = 'http://api.placero.pearnode.com/api/media/update.php';
			$data = array('media' => $mediaObj);
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$mediaObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}else if($dirty_action == "remove"){
			// Call remove api with the data
			error_log("Removing offline media [$mediaObj->id]");
			$url = 'http://api.placero.pearnode.com/api/media/remove.php';
			$data = array('media' => $mediaObj);
			$httpRequest = curl_init();
			curl_setopt($httpRequest, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($httpRequest, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($httpRequest, CURLOPT_POST, 1);
			curl_setopt($httpRequest, CURLOPT_HEADER, 1);
			curl_setopt($httpRequest, CURLOPT_URL, $url);
			curl_setopt($httpRequest, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($httpRequest);
			$resp[$mediaObj->id] = "SUCCESS";
			curl_close($httpRequest);
		}
	}
?>