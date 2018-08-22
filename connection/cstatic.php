<?php
	$username = "timor";
	$password = "timor";
	$hostname = "content.pearnode.com";
	
	// connection to the database
	$dbhandle = mysql_connect ( $hostname, $username, $password ) or die ( "Unable to connect to Database" );
	mysql_select_db ("timor_static_db", $dbhandle ) or die ( "Could not select timor_master_db database" );
?>