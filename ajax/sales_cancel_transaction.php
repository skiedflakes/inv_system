<?php
	include '../core/config.php';
	$sales_id = $_POST["sales_id"];

	$edit = mysqli_query($conn,"UPDATE tbl_sales_order SET status = 2 WHERE sales_order_id = '$sales_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>