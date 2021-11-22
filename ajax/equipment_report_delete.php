<?php
	include '../core/config.php';
	$equipment_report_id = $_POST["equipment_report_id"];

	$count = 0;
	$delete = mysqli_query($conn,"DELETE FROM tbl_equipment_report  WHERE equipment_report_id = '$equipment_report_id'") or die(mysql_error());
		if($delete){
			$count += 1;
		}else{
			$count += 0;
		}

	echo $count;

?>