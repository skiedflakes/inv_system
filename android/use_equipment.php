<?php

	include '../core/config.php';
	$user_id = $_REQUEST["user_id"];
	$stock_id = $_REQUEST["stock_id"];
	date_default_timezone_set('Asia/Manila');
	$date_added = date("Y-m-d H:i:s");
	$edit = mysqli_query($conn,"UPDATE tbl_stocks  SET used_by = '$user_id',used_date = '$date_added' where stock_id = '$stock_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>