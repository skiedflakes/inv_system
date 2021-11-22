<?php
	include '../../core/config.php';

	$data = mysql_query("SELECT * FROM tbl_stocks");
	$response["data"] = array();
	$count = 1;
	while($row = mysql_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["product_id"] = $row["product_id"];
		$list["brand_name"] = $row["brand_name"];
		$list["generic_name"] = $row["generic_name"];
		$list["category_description"] = $row["category_description"];
		$list["price"] = $row["price"];
	
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>