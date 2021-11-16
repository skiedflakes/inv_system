<?php
	include '../core/config.php';
	$location = $_POST["location_name"];

	$add = mysqli_query($conn,"INSERT INTO tbl_location SET location_name = '$location'") or die(mysqli_error($conn));
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>