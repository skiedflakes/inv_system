<?php
	include '../../core/config.php';
	$from = $_POST["fromDate"];
	$to = $_POST["toDate"];

	$data = mysqli_query($conn,"SELECT *, sum(b.quantity)-sum(b.returned_quantity) as qty FROM tbl_sales_order a INNER JOIN tbl_sales_order_detail b WHERE a.sales_order_id = b.sales_order_id AND a.status = 1 AND a.date_added BETWEEN '$from' AND '$to' GROUP BY a.sales_order_id ORDER BY a.sales_order_id DESC");
	$response["data"] = array();
	$total_amount = 0;
	$total_qty = 0;
	while($row = mysqli_fetch_array($data)){
		$total_qty += $row["qty"];
		$total_amount += get_detail_amount($row["sales_order_id"], $conn,$row["is_discounted"]);

		$list = array();
		$list["sales_id"] = $row["sales_order_id"];
		$list["receipt_no"] = $row["receipt_no"];
		$list["trans_date"] = date("Y-m-d", strtotime($row["date_added"]));
		$list["customer"] = get_customer_name($row["customer_id"], $conn);
		$list["quantity"] = $row["qty"];
		$list["amount"] = get_detail_amount($row["sales_order_id"], $conn,$row["is_discounted"]);
		$list["total_quantity"] = $total_qty;
		$list["total_amount"] = number_format($total_amount,2);
		$list["fromDate"] = isset($from)?date("Y-m-d", strtotime($from)):date("Y-m-d");
		$list["toDate"] = isset($to)?date("Y-m-d", strtotime($to)):date("Y-m-d");

		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>