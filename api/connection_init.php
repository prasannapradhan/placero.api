<?php
	$dbhost = 'db.placero.pearnode.com';
	$dbuser = 'placero';
	$dbpass = 'placero';
	$database = 'placerodb';
	$conn = mysqli_connect ( $dbhost, $dbuser, $dbpass, $database );
	if (mysqli_connect_errno ()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error ();
	}
?>
