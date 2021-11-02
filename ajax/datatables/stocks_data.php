<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM
	 `tbl_stocks` a inner join tbl_products b on a.product_id=b.product_id inner join
	  tbl_supplier c on a.supplier_id = c.supplier_id where quantity != sold_quantity");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$total_qty =  $row["quantity"];
		$sold_qty = $row["sold_quantity"];
		$list["count"] = $count++;
		$list["stock_id"] = $row["stock_id"];
		$list["product"] = $row["brand_name"].", ".$row["generic_name"];
		$list["cost_price"] = number_format($row["cost_price"],2);
		$list["remaining_qty"] =$total_qty-$sold_qty;
		$list["lot_no"] = $row["lot_no"];
		$list["supplier_name"] = $row["supplier_name"];
		$list["expiry_date"] = date("Y-m-d", strtotime($row["expiry_date"]));
		$list["date_added"] = date("Y-m-d", strtotime($row["date_added"]));
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>