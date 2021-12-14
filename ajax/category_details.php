<?php
	include '../core/config.php';
	$category_id  = $_REQUEST["category_id"];

	$sql = mysqli_query($conn,"SELECT * FROM tbl_category WHERE category_id  = '$category_id'");
	$row = mysqli_fetch_array($sql);
	echo json_encode($row);

?>