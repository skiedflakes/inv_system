<?php
	include '../core/config.php';
	$prod_id = $_POST["prod_id"];

	$count = 0;
	foreach ($prod_id as  $val) {
		$delete = mysqli_query($conn,"DELETE FROM tbl_products WHERE product_id = '$val'") or die(mysql_error());
		if($delete){
			$count += 1;
		}else{
			$count += 0;
		}
	}

	echo $count;

?>