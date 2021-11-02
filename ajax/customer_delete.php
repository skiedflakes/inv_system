<?php
	include '../core/config.php';
	$cust_id = $_POST["cust_id"];

	$count = 0;
	foreach ($cust_id as  $val) {
		$delete = mysqli_query($conn,"DELETE FROM tbl_customers WHERE customer_id = '$val'") or die(mysql_error());
		if($delete){
			$count += 1;
		}else{
			$count += 0;
		}
	}

	echo $count;

?>