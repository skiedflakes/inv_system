<?php
	include '../core/config.php';
	$location_id = $_POST["location_id"];

	$get = mysqli_fetch_array(mysqli_query($conn,"SELECT location_name FROM tbl_location WHERE location_id = '$location_id'"));
	if($get){
		echo $get[0];
	}else{
		echo 0;
	}

?>