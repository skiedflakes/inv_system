<?php
	include '../core/config.php';
	$brand_name = $_POST["brand_name"];
	$warning_level = $_POST["warning_level"];
	$category_description = $_POST["category_description"];
	$category_id= $_POST["category_id"];
	$add = mysqli_query($conn,"INSERT INTO tbl_products SET brand_name = '$brand_name', generic_name = '' , category_description = '$category_description', warning_level='$warning_level', category_id='$category_id'") or die(mysqli_error($conn));
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>