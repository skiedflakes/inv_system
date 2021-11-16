<?php
	include '../core/config.php';
	$location_id = $_POST["location_id"];
	$location = $_POST["location_name"];

	$edit = mysqli_query($conn,"UPDATE tbl_location SET location_name = '$location' WHERE location_id = '$location_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>