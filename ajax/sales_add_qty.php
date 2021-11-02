<?php
	include '../core/config.php';
	$sales_id = $_POST["sales_id"];
	$prod_qty = $_POST["prod_qty"];

	$add = mysqli_query($conn,"UPDATE tbl_sales_order_detail SET quantity = '$prod_qty' WHERE sales_order_detail_id = '$sales_id'") or die(mysqli_error($conn));
	if($add){
		$get_id = mysqli_fetch_array(mysqli_query($conn,"SELECT sales_order_id FROM tbl_sales_order_detail WHERE sales_order_detail_id = '$sales_id'"));
		echo $get_id[0];
	}else{
		echo 0;
	}

?>