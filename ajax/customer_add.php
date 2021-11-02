<?php
	include '../core/config.php';
	$customer = $_POST["customer_name"];
	$customer_address = $_POST["customer_address"];

	$add = mysqli_query($conn,"INSERT INTO tbl_customers SET customer_name = '$customer', customer_address = '$customer_address'") or die(mysql_error());
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>