<?php
	include '../core/config.php';
    $sales_id = $_POST["sales_id"];
    $sales_detail_id = $_POST["sales_detail_id"];
    $returned_qty = $_POST["returned_qty"];

    $sales_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_sales_order_detail WHERE sales_order_id = '$sales_id' AND sales_order_detail_id = '$sales_detail_id'"));
    $sold_qty = $sales_data['quantity'];

    if($sold_qty < $returned_qty){
        echo 2;
    }else{
        //ADD PURCHASE RETURN IN SALES DETAILS
       $add = mysqli_query($conn, "UPDATE tbl_sales_order_detail SET returned_quantity = '$returned_qty' WHERE sales_order_detail_id = '$sales_detail_id'") or die(mysqli_error($conn));

       //SUBTRACT SOLD QUANTITY IN STOCKS
       $update = mysqli_query($conn, "UPDATE tbl_stocks SET sold_quantity = sold_quantity - '$returned_qty' WHERE stock_id = '$sales_data[stock_id]'") or die(mysqli_error($conn));

       if($add && $update){
            echo 1;
       }else{
            echo 0;
       }
    }


?>