<?php
	include '../core/config.php';
	$product_id = $_POST["product_id"];
	$brand_name = $_POST["brand_name"];
	$generic_name = $_POST["generic_name"];
	$category_description = $_POST["category_description"];

	$edit = mysqli_query($conn,"UPDATE tbl_products SET brand_name = '$brand_name', generic_name = '$generic_name', category_description = '$category_description'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>