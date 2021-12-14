<?php
	include '../core/config.php';
	$equipment_report_id = $_POST["equipment_report_id"];
	$reported_flag_query = mysqli_query($conn,"SELECT * FROM `tbl_stocks` where stock_id = '13' and reported_flag='1';") or die(mysqli_error($conn));
	
	$count_reported_flag = mysqli_num_rows($reported_flag_query);

	if($count_reported_flag>0){
		echo 2;
	}else{
		date_default_timezone_set('Asia/Manila');
		$date_updated = date("Y-m-d H:i:s");
		$edit = mysqli_query($conn,"UPDATE tbl_equipment_report  SET status = 'assessed', date_updated ='$date_updated' WHERE equipment_report_id = '$equipment_report_id'") or die(mysqli_error($conn));
		
		if($edit){
			echo 1;
		}else{
			echo 0;
		}
	}

?>