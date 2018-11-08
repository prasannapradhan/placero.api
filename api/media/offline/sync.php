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
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($mediaObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}else if($dirty_action == "update"){
			// Call update api with the data
			error_log("Updating offline media [$mediaObj->id]");
			$url = 'http://api.placero.pearnode.com/api/media/update.php';
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($mediaObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}else if($dirty_action == "remove"){
			// Call remove api with the data
			error_log("Removing offline media [$mediaObj->id]");
			$url = 'http://api.placero.pearnode.com/api/media/remove.php';
			$options = array(
					'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode($mediaObj),
					),
			);
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			error_log($response);
		}
	}
?>