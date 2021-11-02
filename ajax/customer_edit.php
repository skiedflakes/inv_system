<?php
	include '../core/config.php';
	$customer_id = $_POST["customer_id"];
	$customer = $_POST["customer_name"];
	$customer_address = $_POST["customer_address"];

	$edit = mysqli_query($conn,"UPDATE tbl_customers SET customer_name = '$customer', customer_address = '$customer_address' WHERE customer_id = '$customer_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>