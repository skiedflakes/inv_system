<?php
	include '../core/config.php';
    $product_id = $_POST["product_id"];
    $supplier_id = $_POST["supplier_id"];
    $location_id = $_POST["location_id"];
    $expiry_date = $_POST["expiry_date"];
    $cost_price = $_POST["cost_price"];
    $engine_number = $_POST["engine_number"];
    
    $date_added = date("Y-m-d");

	$add = mysqli_query($conn,"INSERT INTO `tbl_stocks` (`product_id`, `supplier_id`, `location_id`, `expiry_date`, `date_added`,`date_updated`,`date_repair`,`cost_price`,`engine_number`,`status`) 
    VALUES ('$product_id', '$supplier_id', '$location_id', '$expiry_date', '$date_added','$date_added', '$date_added','$cost_price','$engine_number','Healthy')") or die(mysql_error());
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>