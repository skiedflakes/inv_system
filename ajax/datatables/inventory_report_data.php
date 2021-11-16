<?php
	include '../../core/config.php';
	$date = $_POST["asOfDate"];

	$data = mysqli_query($conn,"SELECT * from tbl_stocks a INNER JOIN tbl_products b on a.product_id = b.product_id group by b.product_id;");
	$response["data"] = array();
	$total_amount = 0;
	$total_qty = 0;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["product_id"] = $row["product_id"];
		$list["product_name"] = $row["brand_name"];
	
		// $list["balance"] = get_balance_qty($row["product_id"], $date, $conn);
		$list["stock_in"] = stock_in_qty($row["product_id"], $date, $conn);
		$list["stock_out"] = stock_out_qty($row["product_id"], $date, $conn);
	 	$list["for_repair"] = for_repair($row["product_id"], $date, $conn);
		$list["remaining_stock"] = get_remaining_qty($row["product_id"], $date, $conn);
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>