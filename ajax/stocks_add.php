<?php
	include '../core/config.php';
    $product_id = $_POST["product_id"];
    $supplier_id = $_POST["supplier_id"];
    $quantity = $_POST["quantity"];
    $expiry_date = $_POST["expiry_date"];
    $cost_price = $_POST["cost_price"];
    $lot_no = $_POST["lot_no"];
    $date_added = date("Y-m-d");

	$add = mysqli_query($conn,"INSERT INTO `tbl_stocks` (`product_id`, `supplier_id`, `quantity`, `sold_quantity`, `returned_quantity`,`lot_no`, `expiry_date`, `date_added`,`date_updated`,`date_returned`,`cost_price`) 
    VALUES ('$product_id', '$supplier_id', '$quantity', '0', '0','$lot_no', '$expiry_date', '$date_added','$date_added', '$date_added','$cost_price')") or die(mysql_error());
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>