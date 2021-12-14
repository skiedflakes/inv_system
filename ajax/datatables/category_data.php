<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM tbl_category");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["category_id"] = $row["category_id"];
		$list["categeory_name"] = $row["name"];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>