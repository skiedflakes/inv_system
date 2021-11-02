<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM tbl_customers");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["customer_id"] = $row["customer_id"];
		$list["customer_name"] = $row["customer_name"];
		$list["customer_address"] = $row["customer_address"];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>