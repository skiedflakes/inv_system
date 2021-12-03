<?php
	include '../core/config.php';
	$product_id = $_POST["product_id"];
	$brand_name = $_POST["brand_name"];
	$warning_level = $_POST["update_warning_level"];
	$category_description = $_POST["category_description"];

	$edit = mysqli_query($conn,"UPDATE tbl_products SET brand_name = '$brand_name', warning_level = '$warning_level', category_description = '$category_description' where product_id = '$product_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>