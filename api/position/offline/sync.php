<?php
	header ( "Access-Control-Allow-Origin: *" );
	include ($_SERVER ["DOCUMENT_ROOT"] . "/connection/cmaster.php");
	
	$positions = json_decode($_POST['positions']);
	foreach ($positions as $positionObj) {
		$dirty_action = $positionObj->dirtyAction;
		if($dirty_action == "create"){
			// Call create api with the data
			error_log("Creating new offline position [$positionObj->id]");
			$url = 'http://api.placero.pearnode.com/api/position/create.php';
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($positionObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}else if($dirty_action == "update"){
			// Call update api with the data
			error_log("Updating offline position [$positionObj->id]");
			$url = 'http://api.placero.pearnode.com/api/position/update.php';
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($positionObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}else if($dirty_action == "remove"){
			// Call remove api with the data
			error_log("Removing offline position [$positionObj->id]");
			$url = 'http://api.placero.pearnode.com/api/position/remove.php';
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($positionObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}
	}
?>