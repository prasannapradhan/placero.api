<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$areas = json_decode($_POST['areas']);
	foreach ($areas as $areaObj) {
		$dirty_action = $areaObj->dirtyAction;
		if($dirty_action == "create"){
			// Call create api with the data
			error_log("Creating new offline area [$areaObj->id]");
			$url = 'http://api.placero.pearnode.com/api/area/create.php';
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($areaObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}else if($dirty_action == "update"){
			// Call update api with the data
			error_log("Updating offline area [$areaObj->id]");
			$url = 'http://api.placero.pearnode.com/api/area/update.php';
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($areaObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}else if($dirty_action == "remove"){
			// Call remove api with the data
			error_log("Removing offline area [$areaObj->id]");
			$url = 'http://api.placero.pearnode.com/api/area/remove.php';
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($areaObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}
	}
?>