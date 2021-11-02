<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM
	 `tbl_sales_order` a inner join tbl_sales_order_detail b on a.sales_order_id=b.sales_order_id where returned_quantity !=0");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["sales_detail_id"] = $row["sales_order_detail_id"];
		$list["receipt_no"] = $row["receipt_no"];
		$list["product"] = get_product_name($row['product_id'], $conn);
		$list["returned_quantity"] =  $row["returned_quantity"];
		$list["date_added"] = date("F d, Y", strtotime($row["date_added"]));
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>