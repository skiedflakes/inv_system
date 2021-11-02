<?php
	include '../core/config.php';
    $sales_detail_id = $_POST["sales_detail_id"];

    $count = 0;
    foreach ($sales_detail_id as  $val) {

      $sales_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_sales_order_detail WHERE sales_order_detail_id = '$val'"));

      //STOCKS
      $update = mysqli_query($conn, "UPDATE tbl_stocks SET sold_quantity = sold_quantity + '$sales_data[returned_quantity]' WHERE stock_id = '$sales_data[stock_id]'") or die(mysqli_error($conn));

      //SALES DETAILS
      $add = mysqli_query($conn, "UPDATE tbl_sales_order_detail SET returned_quantity = returned_quantity - '$sales_data[returned_quantity]' WHERE sales_order_detail_id = '$val'") or die(mysqli_error($conn));

      if($delete){
        $count += 1;
      }else{
        $count += 0;
      }
    }
    echo $count;
?>