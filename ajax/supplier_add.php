<?php
	include '../core/config.php';
	$supplier = $_POST["supplier_name"];

	$add = mysqli_query($conn,"INSERT INTO tbl_supplier SET supplier_name = '$supplier'") or die(mysqli_error($conn));
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>