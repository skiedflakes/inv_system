<?php
	include '../../core/config.php';
	$sales_id = $_POST["sales_id"];
	$is_discounted = $_POST["disc"];

	$data = mysqli_query($conn,"SELECT * FROM tbl_sales_order a INNER JOIN tbl_sales_order_detail b ON a.sales_order_id = b.sales_order_id INNER JOIN tbl_products c ON b.product_id = c.product_id WHERE a.sales_order_id = '$sales_id'");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		//$vat = $row["is_vatable"] == 1?0.12:0;
		$vat =0;
		$discount = $row["is_discountable"] == 1?0.20:0;

		if($is_discounted == 0){
			$vat_price = $row["is_vatable"] == 1?$row["price"]*0.12:0;
			$disc_price = 0;
			$final_price = $row["price"];
		}else{
			$vat_price = $row["is_vatable"] == 1?$row["price"]*0.12:0;
			$disc_price = $discount != 0?$row["price"]*$discount:0;
			$final_price = $row["price"]-$disc_price;
		}

		$list = array();
		$list["count"] = $count++;
		$list["sales_id"] = $row["sales_order_id"];
		$list["sales_detail_id"] = $row["sales_order_detail_id"];
		$list["product_name"] = $row["brand_name"].", ".$row["generic_name"];
		$list["product_price"] = number_format($final_price ,2);
		$list["vat"] = number_format($vat_price ,2);
		$list["quantity"] = $row["quantity"];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>