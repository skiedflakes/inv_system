<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM tbl_products");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["product_id"] = $row["product_id"];
		$list["brand_name"] = $row["brand_name"];
		$list["generic_name"] = $row["generic_name"];
		$list["warning_level"] = $row["warning_level"];
		$list["category_description"] = $row["category_description"];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>