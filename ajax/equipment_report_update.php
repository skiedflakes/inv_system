<?php
	include '../core/config.php';
	$status = $_POST["status"];
	$equipment_report_id = $_POST["equipment_report_id"];

	$edit = mysqli_query($conn,"UPDATE tbl_equipment_report  SET status = '$location' WHERE equipment_report_id = '$equipment_report_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>