<?php
	include '../../core/config.php';
	$date = $_POST["asOfDate"];

	$data = mysqli_query($conn,"SELECT * FROM tbl_products");
	$response["data"] = array();
	$total_amount = 0;
	$total_qty = 0;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["product_name"] = $row["brand_name"].", ".$row["generic_name"];
		$list["price"] = $row["price"];
		$list["balance"] = get_balance_qty($row["product_id"], $date, $conn);
		$list["stock_in"] = stock_in_qty($row["product_id"], $date, $conn);
		$list["stock_out"] = stock_out_qty($row["product_id"], $date, $conn);
		$list["remaining_qty"] = get_remaining_qty($row["product_id"], $date, $conn);

		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>