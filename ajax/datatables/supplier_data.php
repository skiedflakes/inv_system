<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM tbl_supplier");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["supplier_id"] = $row["supplier_id"];
		$list["supplier_name"] = $row["supplier_name"];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>