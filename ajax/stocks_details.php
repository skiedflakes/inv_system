<?php
	include '../core/config.php';
	$stock_id = $_POST["stock_id"];

	$sql = mysqli_query($conn,"SELECT * FROM
    `tbl_stocks` a inner join tbl_products b on a.product_id=b.product_id inner join
     tbl_supplier c on a.supplier_id = c.supplier_id where a.quantity != a.sold_quantity and a.stock_id = '$stock_id'");
	$row = mysqli_fetch_array($sql);
	echo json_encode($row);

?>