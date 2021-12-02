<?php
	include '../../core/config.php';
	$date = $_POST["asOfDate"];
	$data = mysqli_query($conn,"SELECT *,c.engine_number engine_no,a.date_added report_date,a.date_updated as report_update,a.status as report_status,d.location_name as location, e.brand_name as product_name FROM tbl_equipment_report a inner join tbl_users b on a.user_id=b.user_id inner join tbl_stocks c on a.stock_id = c.stock_id inner join tbl_location d on c.location_id= d.location_id inner join tbl_products e on c.product_id = e.product_id where DATE(a.date_added) ='$date' order by a.status ASC;");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
	
		$list["equipment_report_id"] = $row["equipment_report_id"];
		$list["report_detail"] = $row["report_detail"];
		$list["name"] = $row["name"];
		$list["product_name"] = $row["product_name"];
		$list["location"] = $row["location"];
		$list["engine_no"] = $row["engine_no"];
		$list["position"] = $row["position"];
        $list["date_added"] = date("Y-m-d h:i:s a", strtotime($row["report_date"]));
        $list["date_updated"] =date("Y-m-d h:i:s a", strtotime($row["report_update"]));
		$list["status"] = $row['report_status'];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>