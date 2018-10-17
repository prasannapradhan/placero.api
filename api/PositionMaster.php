<?php
        require 'connection_init.php';
        $requestType = isset($_POST["requestType"]) ? $_POST["requestType"] : "1";
        $queryType = isset($_POST["queryType"]) ? $_POST["queryType"] : "";
        $deviceID = isset($_POST["deviceID"])?$_POST["deviceID"]:"";
        $centerLong = isset($_POST["lon"])?$_POST["lon"]:"";
        $centerLat = isset($_POST["lat"])?$_POST["lat"]:"";
        $desc = isset($_POST["desc"]) ? $_POST["desc"]:"";
        $tags = isset($_POST["tags"]) ? $_POST["tags"]:"";
        $name = isset($_POST["name"]) ? $_POST["name"]:"";
        $type = isset($_POST["type"]) ? $_POST["type"]:"";
        $createdOn = isset($_POST["created_on"]) ? $_POST["created_on"]:"";
        $uniqueId = isset($_POST["uniqueId"]) ? $_POST["uniqueId"]:"";
        $uniqueAreaId = isset($_POST["uniqueAreaId"]) ? $_POST["uniqueAreaId"]:"";
        if($queryType == 'insert'){
        $query = "insert into PositionMaster (deviceID , lon , lat , description , name , createdOn , uniqueId ,uniqueAreaId , tags , type ) values('$deviceID','$centerLong','$centerLat','$desc','$name','$createdOn','$uniqueId','$uniqueAreaId','$tags','$type')";
	 }else if($queryType == 'update'){
        $query ="update PositionMaster SET deviceID = '$deviceID' , lon = '$centerLong' , lat = '$centerLat', description = '$desc' , name = '$name' , uniqueAreaId = '$uniqueAreaId' , tags = '$tags' , type = '$type' where uniqueId = '$uniqueId'";
        }else if($queryType == 'delete'){
        $query = "delete from PositionMaster where uniqueId = '$uniqueId'";
        }
echo $query;
       if (! mysqli_query($conn,$query)){
	echo("Error description: " . mysqli_error($conn));
	}
        mysqli_close($conn);
?>
