<?php
	header("Access-Control-Allow-Origin: *");

	$connection = mysql_connect ('content.pearnode.com', 'timor', 'timor' ) or die ( "Unable to connect to child Database" );
	mysql_select_db('PF_02bc4081027217290b364e5f0a8605f44d682080', $connection) or die ( "Could not select db" );
	
	
	$stock_qry = "select * from STOCK_ITEM";
	$resp = array();
	
	$stock_result = mysql_query($stock_qry);
	$stock_arr = array();
	while ($stock_row = mysql_fetch_object($stock_result)) {
		array_push($stock_arr, $stock_row);
	}
	mysql_free_result($stock_result);
	
	$resp['stock'] = $stock_arr;
	echo json_encode ($resp);
?>