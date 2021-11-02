<?php
	include '../core/config.php';
	$product_id = $_POST["product_id"];

	$sql = mysqli_query($conn,"SELECT * FROM tbl_products WHERE product_id = '$product_id'");
	$row = mysqli_fetch_array($sql);
	echo json_encode($row);

?>