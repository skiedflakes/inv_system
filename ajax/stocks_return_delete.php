<?php
	include '../core/config.php';
    $stock_id = $_POST["stock_id"];
    $count = 0;
	foreach ($stock_id as  $val) {
    $fetch_data = mysqli_query($conn,"SELECT * FROM `tbl_stocks` where stock_id = '$val'") or die(mysql_error());
    $get_data = mysqli_fetch_assoc($fetch_data);
    $qty = $get_data['quantity'];
    $sold_qty = $get_data['sold_quantity'];
    $returned_quantity = $get_data['returned_quantity'];
    $remaining_qty =  $qty-$sold_qty;


        
        $update_quantity =  $qty+$returned_quantity;
        $update = mysqli_query($conn,"UPDATE `tbl_stocks` SET `quantity` = '$update_quantity', `returned_quantity` = '0' WHERE `tbl_stocks`.`stock_id` = '$val'") or die(mysql_error());

        if($update){
            $count += 1;
        }else{
            $count += 0;
        }
    }
    echo $count;

?>