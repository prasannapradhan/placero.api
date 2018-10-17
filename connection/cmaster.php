<?php
	$username = "placero";
	$password = "placero";
	$hostname = "placero.pearnode.com";
	
	// connection to the database
	$dbhandle = mysql_connect ( $hostname, $username, $password ) or die ( "Unable to connect to Database" );
	mysql_select_db ("placero_db", $dbhandle ) or die ( "Could not select placero_db database" );
?>