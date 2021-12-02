<?php
	include '../core/config.php';
	$stock_id = $_POST["e_stock_id"];
    $product = $_POST["e_product"];
    $location_id = $_POST["e_location_id"];
    $supplier = $_POST["e_supplier"];
    $cost_price = $_POST["e_cost_price"];
    $expiry_date = $_POST["e_expiry_date"];
    $status = $_POST["e_status"];
    $engine_number = $_POST["e_engine_number"];
    date_default_timezone_set('Asia/Manila');
    $date_repair = $_POST["e_sched_repair"];
    $date_added = date("Y-m-d");
  
    //EDIT DETAILS
    $edit_stock = mysqli_query($conn,"UPDATE `tbl_stocks` SET `product_id` = '$product', `supplier_id` = '$supplier', `cost_price` = '$cost_price', `expiry_date` = '$expiry_date', `location_id` = '$location_id', `status` ='$status', `engine_number` = '$engine_number' , `date_repair` = '$date_repair' WHERE `stock_id` = '$stock_id'") or die(mysql_error());
    
    if($edit_stock){

        echo 1;
    }else{
        echo 0;
    }





?>