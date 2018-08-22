<?php
	header("Access-Control-Allow-Origin: *");

	$connection = mysql_connect ('content.pearnode.com', 'timor', 'timor' ) or die ( "Unable to connect to child Database" );
	mysql_select_db('IN_02bc4081027217290b364e5f0a8605f44d682080', $connection) or die ( "Could not select db" );
	
	$prod_qry = "SELECT product_name as pn, product_code as pc, parent_name as ppn, unit from PRODUCT_DEF";
	
	$resp = array();
	$prod_result = mysql_query($prod_qry);
	while ($prod_row = mysql_fetch_object($prod_result)) {
		
		$prod_attrs_qry = "SELECT pa.attr_name as an,pa.attr_value as av,pa.attr_category as ac  
				FROM PRODUCT_ATTRIBUTES pa where pa.product_code = '".$prod_row->pc."'";

		$prod_attrs_result = mysql_query($prod_attrs_qry);
		$attributes = array();
		
		$continue_loop = true;
		while ($prod_attrs_row = mysql_fetch_object($prod_attrs_result)) {
			$an = $prod_attrs_row->an;
			$av = $prod_attrs_row->av;
			if($an == "displayable" && $av == "false"){
				$continue_loop = false;
				break;
			}
			array_push($attributes, $prod_attrs_row);
		}
		
		if(!$continue_loop){
			continue;
		}
		
		$record = array();
		$record['attrs'] = $attributes;
		$record['det'] = $prod_row;
		
		array_push($resp, $record);
		mysql_free_result($prod_attrs_result);
	}
	mysql_free_result($prod_result);
	echo json_encode ( $resp );
?>