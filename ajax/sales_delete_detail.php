<?php
	include '../core/config.php';
	$sales_id = $_POST["sales_id"];
	$get_id = mysqli_fetch_array(mysqli_query($conn,"SELECT sales_order_id FROM tbl_sales_order_detail WHERE sales_order_detail_id = '$sales_id'"));
	$new_sales_id = $get_id[0];
	$delete = mysqli_query($conn,"DELETE FROM tbl_sales_order_detail WHERE sales_order_detail_id = '$sales_id'") or die(mysqli_error($conn));
	if($delete){
		echo $new_sales_id;
	}else{
		echo 0;
	}

?>