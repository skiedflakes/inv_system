<?php
	include '../core/config.php';
	$report_detail = $_POST["report_detail"];
	$edit = mysqli_query($conn,"INSERT INTO tbl_equipment_report  SET status = 'pending',report_detail = '$report_detail', ") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>