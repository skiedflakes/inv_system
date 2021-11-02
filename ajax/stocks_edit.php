<?php
	include '../core/config.php';
	$stock_id = $_POST["stock_id"];
    $product = $_POST["product"];
    $supplier = $_POST["supplier"];
    $cost_price = $_POST["cost_price"];
    $expiry_date = $_POST["expiry_date"];
    $remaining_qty = $_POST["remaining_qty"];
    $sold_qty = $_POST["sold_qty"];
    $updated_qty = $_POST["updated_qty"];
    $lot_no = $_POST["lot_no"];

    //EDIT DETAILS
    $edit_stock = mysqli_query($conn,"UPDATE `tbl_stocks` SET `product_id` = '$product', `supplier_id` = '$supplier', `cost_price` = '$cost_price', `expiry_date` = '$expiry_date',`lot_no` = '$lot_no'  WHERE `stock_id` = '$stock_id'") or die(mysql_error());
    
    if($edit_stock){

        //NEW QUANTITY
        if($updated_qty>$remaining_qty){
            $fquantity = $sold_qty +$updated_qty;


            $edit = mysqli_query($conn,"UPDATE `tbl_stocks` SET `quantity` = '$fquantity' WHERE `tbl_stocks`.`stock_id` = '$stock_id'") or die(mysql_error());
            if($edit){
                echo 1;
            }else{
                echo 0;
            }
        }else if($updated_qty==$remaining_qty){
            $edit1 = mysqli_query($conn,"UPDATE `tbl_stocks` SET `quantity` = '$updated_qty' WHERE `tbl_stocks`.`stock_id` = '$stock_id'") or die(mysql_error());
            if($edit1){
                echo 1;
            }else{
                echo 0;
            }
        }else if($updated_qty<$remaining_qty){


            $fquantity = $sold_qty +$updated_qty;
         
            $edit2 = mysqli_query($conn,"UPDATE `tbl_stocks` SET `quantity` = '$fquantity' WHERE `tbl_stocks`.`stock_id` = '$stock_id'") or die(mysql_error());
            if($edit2){
                echo 1;
            }else{
                echo 0;
            }
        }
    }else{
        echo 0;
    }





?>