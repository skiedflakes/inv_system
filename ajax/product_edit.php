<?php
	include '../core/config.php';
	$product_id = $_POST["product_id"];
	$brand_name = $_POST["brand_name"];
	$generic_name = $_POST["generic_name"];
	$category_description = $_POST["category_description"];
	$product_price = $_POST["product_price"];
	$gross_price = $_POST["gross_price"];
	$is_vatable = isset($_POST["is_vatable"])?$_POST["is_vatable"]:0;
	$is_discountable = isset($_POST["is_discountable"])?$_POST["is_discountable"]:0;

	$edit = mysqli_query($conn,"UPDATE tbl_products SET brand_name = '$brand_name', generic_name = '$generic_name', category_description = '$category_description', price = '$product_price', gross_price = '$gross_price', is_vatable = '$is_vatable', is_discountable = '$is_discountable' WHERE product_id = '$product_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>