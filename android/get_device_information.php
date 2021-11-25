<?php
	include '../core/config.php';
	session_start();
	$qr_code = 	$_REQUEST["qr_code"];
	$f = explode("-",$qr_code);
	$stock_id = $f[0];

	$data = mysqli_query($conn,"SELECT * FROM
	 `tbl_stocks` a inner join tbl_products b on a.product_id=b.product_id inner join
	  tbl_supplier c on a.supplier_id = c.supplier_id inner join tbl_location d on a.location_id = d.location_id where a.stock_id = '$stock_id'");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["stock_id"] = $row["stock_id"];
		$list["product"] = $row["brand_name"].", ".$row["generic_name"];
		$list["cost_price"] = number_format($row["cost_price"],2);
		$list["location_name"] =$row["location_name"];
		$list["engine_number"] =$row["engine_number"];
		$status =$row["status"];
		$list["date_repair"] = date("Y-m-d", strtotime($row["date_repair"]));
		$list["status"] =$status;
		
		$list["supplier_name"] = $row["supplier_name"];
		$list["expiry_date"] = date("Y-m-d", strtotime($row["expiry_date"]));
	
	
		$list["date_added"] = date("Y-m-d", strtotime($row["date_added"]));
		array_push($response["data"], $list);
	}

	echo json_encode($response);



?>