<?php
	include '../core/config.php';
	$equipment_report_id = $_POST["equipment_report_id"];
	date_default_timezone_set('Asia/Manila');
	$date_updated = date("Y-m-d H:i:s");
	$edit = mysqli_query($conn,"UPDATE tbl_equipment_report  SET status = 'assessed', date_updated ='$date_updated' WHERE equipment_report_id = '$equipment_report_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>