<?php
	require 'connection_init.php';
	//post extracts
	$name = isset($_POST["name"])? $_POST["name"]: "";
	$type = isset($_POST["type"]) ? $_POST["type"] : "";
	$typeField = isset($_POST["type_field"]) ? $_POST["type_field"] : "";
	$context = isset($_POST["context"]) ? $_POST["context"] : "";
	$context_id = isset($_POST["context_id"]) ? $_POST["context_id"] : "";
	$query_type = isset($_POST["query_type"]) ? $_POST["query_type"] : "";
	if($query_type=="insert"){
		$query ="insert into tag_master (name, type , type_field , context , context_id ) VALUES ('$name','$type','$type_field','$context','$context_id','$query_type')";
	}else if ($query_type=="update"){
		$query = "";
		echo "update query not supported";
	}
	mysqli_query($conn,$query);
	mysqli_close($conn);
?>
