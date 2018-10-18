<?php
	require 'connection_init.php';
	// post extracts
	$query_type = isset ( $_POST ["query_type"] ) ? $_POST ["query_type"] : "";
	$source_user = isset ( $_POST ["source_user"] ) ? $_POST ["source_user"] : "";
	$target_user = isset ( $_POST ["target_user"] ) ? $_POST ["target_user"] : "";
	$source_user = isset ( $_POST ["source_user"] ) ? $_POST ["source_user"] : "";
	$function_codes = isset ( $_POST ["function_codes"] ) ? $_POST ["function_codes"] : "";
	$area_id = isset ( $_POST ["area_id"] ) ? $_POST ["area_id"] : "";
	$query = "insert into AreaShare (source_user, target_user , area_id , function_codes) VALUES ('$source_user','$target_user','$area_id','$function_codes')";
	// echo $query;
	mysqli_query ( $conn, $query );
	mysqli_close ( $conn );
?>
