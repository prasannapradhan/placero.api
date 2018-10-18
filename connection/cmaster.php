<?php
	$username = "placero";
	$password = "placero";
	$hostname = "placero.pearnode.com";
	
	// connection to the database
	$conn = mysql_connect ( $hostname, $username, $password ) or die ( "Unable to connect to Database" );
	mysql_select_db ("placerodb", $conn ) or die ( "Could not select placerodb database" );
?>