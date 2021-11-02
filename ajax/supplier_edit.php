<?php
	include '../core/config.php';
	$supplier_id = $_POST["supplier_id"];
	$supplier = $_POST["supplier_name"];

	$edit = mysqli_query($conn,"UPDATE tbl_supplier SET supplier_name = '$supplier' WHERE supplier_id = '$supplier_id'") or die(mysqli_error($conn));
	if($edit){
		echo 1;
	}else{
		echo 0;
	}

?>