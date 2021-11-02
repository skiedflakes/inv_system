<?php
	include '../core/config.php';
	$customer_id = $_POST["customer_id"];

	$sql = mysqli_query($conn,"SELECT * FROM tbl_customers WHERE customer_id = '$customer_id'");
	$row = mysqli_fetch_array($sql);
	echo json_encode($row);

?>