<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT *,a.status as report_status FROM tbl_equipment_report a inner join tbl_users b on a.user_id=b.user_id order by a.status ASC");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
	
		$list["equipment_report_id"] = $row["equipment_report_id"];
		$list["report_detail"] = $row["report_detail"];
		$list["name"] = $row["name"];
		$list["position"] = $row["position"];
        $list["date_added"] = date("Y-m-d H:i:s a", strtotime($row["date_added"]));
        $list["date_updated"] =date("Y-m-d H:i:s a", strtotime($row["date_updated"]));
		$list["status"] = $row['report_status'];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>