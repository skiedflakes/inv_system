<?php
	include '../core/config.php';
	$supp_id = $_POST["location_id"];

	$count = 0;
	foreach ($supp_id as  $val) {
		$delete = mysqli_query($conn,"DELETE FROM tbl_location WHERE location_id = '$val'") or die(mysql_error());
		if($delete){
			$count += 1;
		}else{
			$count += 0;
		}
	}

	echo $count;

?>