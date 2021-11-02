<?php
	include '../core/config.php';
    $quantity = $_POST["quantity"];
    $stock_id = $_POST["stock_id"];

    $fetch_data = mysqli_query($conn,"SELECT * FROM `tbl_stocks` where stock_id = '$stock_id'") or die(mysql_error());
    $get_data = mysqli_fetch_assoc($fetch_data);
    $qty = $get_data['quantity'];
    $sold_qty = $get_data['sold_quantity'];
    $returned_quantity = $get_data['returned_quantity'];
    $remaining_qty =  $qty-$sold_qty;

    if($quantity>$remaining_qty){
        echo 0;
    }else{
        
        $update_quantity =  $qty-$quantity;
        $update_returned_quantity =   $returned_quantity+$quantity;
        $update = mysqli_query($conn,"UPDATE `tbl_stocks` SET `quantity` = '$update_quantity', `returned_quantity` = '$update_returned_quantity' WHERE `tbl_stocks`.`stock_id` = '$stock_id'") or die(mysql_error());

        if($update){
            echo 1;
        }else{
            echo 0;
        }
    }


?>