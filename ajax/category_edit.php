<?php
	include '../core/config.php';
	$category_id = $_POST["category_id"];
	$name = $_POST["name"];

	$edit = mysqli_query($conn,"UPDATE tbl_category SET name = '$name' where category_id = '$category_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>