<?php
	include '../core/config.php';
	$supp_id = $_POST["supp_id"];

	$get = mysqli_fetch_array(mysqli_query($conn,"SELECT supplier_name FROM tbl_supplier WHERE supplier_id = '$supp_id'"));
	if($get){
		echo $get[0];
	}else{
		echo 0;
	}

?>