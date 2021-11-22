<?php
	include '../core/config.php';
	$brand_name = $_POST["brand_name"];
	$category_description = $_POST["category_description"];

	$add = mysqli_query($conn,"INSERT INTO tbl_products SET brand_name = '$brand_name', generic_name = '' , category_description = '$category_description'") or die(mysqli_error($conn));
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>