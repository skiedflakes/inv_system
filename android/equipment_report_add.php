<?php
	include '../core/config.php';
	$report_detail = $_REQUEST["report_detail"];
	$user_id = $_REQUEST["user_id"];
	$stock_id = $_REQUEST['stock_id'];

	date_default_timezone_set('Asia/Manila');

    $date_added = date("Y-m-d H:i:s");


	$edit = mysqli_query($conn,"INSERT INTO tbl_equipment_report  SET status = 'pending', report_detail = '$report_detail', user_id = '$user_id' ,stock_id = '$stock_id', date_added ='$date_added',  date_updated ='$date_added'") or die(mysqli_error($conn));
	if($edit){
		$edit2 = mysqli_query($conn,"UPDATE tbl_stocks  SET report_flag = '1' where stock_id = '$stock_id'") or die(mysqli_error($conn));
		if($edit2){
			echo 1;
		}else{
			echo 0;
		}
	}else{
		echo 0;
	}

?>