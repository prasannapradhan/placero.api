<?php
        $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = 'pradipta123';
         $database= 'bhutatra';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $database);
        if (mysqli_connect_errno())
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
         } 
 ?>
