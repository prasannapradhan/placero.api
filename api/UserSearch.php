<?php
	require 'connection_init.php';
        $ss = isset($_GET["ss"])? $_GET["ss"]: "";
        $sf = isset($_GET["sf"]) ? $_GET["sf"] : "";

        $query ="select * from  user_master where ".$sf." = '$ss'";
//	echo $query;
        $result = mysqli_query($conn,$query);
	if (!$result){
        echo("Error description: " . mysqli_error($conn));
        }
	$user_result = "[";
	$i = 0;
	if (mysqli_num_rows($result) > 0) {
    		// output data of each row
    		while($row = mysqli_fetch_assoc($result)) {

		if($i>0){
                 $user_result .= ",";
		}

		$user_result.="{\"id\":\"".$row["id"]."\",\"displayName\":\"".$row["displayName"]."\",\"email\":\"".$row["email"]."\",\"familyName\":\"".$row["familyName"]."\",\"givenName\":\"".$row["givenName"]."\",\"photoUrl\":\"".$row["photoUrl"]."\",\"authSystemId\":\"".$row["authSystemId"]."\",\"deviceID\":\"".$row["deviceID"]."\",\"tags\":\"\",\"tag_types\":\"\"}";
   			 
		$i+=1;
		}
		echo $user_result."]";
	} else {
		    echo "[]";
	}
        mysqli_close($conn);
?>
