<?php
	include '../core/config.php';
	$name = $_POST["name"];

	$add = mysqli_query($conn,"INSERT INTO tbl_category SET name = '$name'") or die(mysqli_error($conn));
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>