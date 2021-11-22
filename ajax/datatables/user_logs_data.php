<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM
	 `tbl_stocks` a inner join tbl_products b on a.product_id=b.product_id inner join
	  tbl_supplier c on a.supplier_id = c.supplier_id inner join tbl_location d on a.location_id = d.location_id ");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["stock_id"] = $row["stock_id"];
		$list["product"] = $row["brand_name"].", ".$row["generic_name"];
		$list["cost_price"] = number_format($row["cost_price"],2);
		$list["location_name"] =$row["location_name"];
		$list["engine_number"] =$row["engine_number"];
		$status =$row["status"];

		if($status=="Healthy"){
			$list["date_repair"] = "N/A";
			$list["status"] =	"<h3 class='btn  btn-sm btn-success'>Healthy</h3>";
		}else if($status=="Repair"){
			$list["date_repair"] = date("Y-m-d", strtotime($row["date_repair"]));
			$list["status"] =	"<h3 class='btn  btn-sm btn-warning'>Repair</h3>";
		}else if($status=="Malfunctioned"){
			$list["date_repair"] = "N/A";
			$list["status"] =	"<h3 class='btn btn-sm btn-danger'>Malfunctioned</h3>";
		}
		
		$list["supplier_name"] = $row["supplier_name"];
		$list["expiry_date"] = date("Y-m-d", strtotime($row["expiry_date"]));
		$list["last_user"] = $row["used_by"];
		$list["last_used_date"] =date("Y-m-d H:i:s a", strtotime($row["used_date"]));
	
		$list["date_added"] = date("Y-m-d", strtotime($row["date_added"]));
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>