<?php
	include '../core/config.php';
	$stock_id = $_POST["stock_id"];

	$count = 0;
	foreach ($stock_id as  $val) {
		$delete = mysqli_query($conn,"DELETE FROM tbl_stocks WHERE stock_id = '$val'") or die(mysql_error());
		if($delete){
			$count += 1;
		}else{
			$count += 0;
		}
	}

	echo $count;

?>