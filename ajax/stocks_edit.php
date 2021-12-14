<?php
session_start();
    $updated_by = $_SESSION["uid"];
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
    

    if( $status=='Repair'){
        $add = mysqli_query($conn,"INSERT INTO tbl_repair_history SET stock_id = '$stock_id', user_id = '$updated_by' , repair_date = '$date_repair', date_added='$date_added'") or die(mysqli_error($conn));
        if($add){
            $edit_stock = mysqli_query($conn,"UPDATE `tbl_stocks` SET `product_id` = '$product', `supplier_id` = '$supplier', `cost_price` = '$cost_price', `expiry_date` = '$expiry_date', `location_id` = '$location_id', `status` ='$status', `engine_number` = '$engine_number' , `date_repair` = '$date_repair', `reported_flag` ='0'  WHERE `stock_id` = '$stock_id'") or die(mysql_error());
            
            if($edit_stock){
    
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }else{
   //EDIT DETAILS
        $edit_stock = mysqli_query($conn,"UPDATE `tbl_stocks` SET `product_id` = '$product', `supplier_id` = '$supplier', `cost_price` = '$cost_price', `expiry_date` = '$expiry_date', `location_id` = '$location_id', `status` ='$status', `engine_number` = '$engine_number' , `date_repair` = '$date_repair', `reported_flag` ='0'  WHERE `stock_id` = '$stock_id'") or die(mysql_error());
            
        if($edit_stock){

            echo 1;
        }else{
            echo 0;
        }

    }
 




?>