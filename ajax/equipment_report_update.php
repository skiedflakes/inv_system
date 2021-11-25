<?php
	include '../core/config.php';
	$equipment_report_id = $_POST["equipment_report_id"];
    $date_added = date("Y-m-d h:m:s");
	$edit = mysqli_query($conn,"UPDATE tbl_equipment_report  SET status = 'assessed' WHERE equipment_report_id = '$equipment_report_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>