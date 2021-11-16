<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM tbl_location");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["location_id"] = $row["location_id"];
		$list["location_name"] = $row["location_name"];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>