<?php
	include '../core/config.php';
	$user_id = $_POST["use_id"];

	$sql = mysqli_query($conn,"SELECT * FROM
    `tbl_users` where user_id = '$user_id'");
	$row = mysqli_fetch_array($sql);
	echo json_encode($row);

?>