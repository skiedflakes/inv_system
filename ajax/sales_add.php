<?php
	include '../core/config.php';
	$products = $_POST["products"];
	$sales_id = $_POST["sales_id"];
	$date_added = date("Y-m-d");

	$check_balance_qty = check_balance_qty($products, $conn);
	$fetch_product_details = mysqli_query($conn,"SELECT * from tbl_products where product_id='$products'") or die(mysqli_error($conn));
	$fetch_price = mysqli_fetch_array($fetch_product_details);

	$cur_price = $fetch_price['price'];
	$gross_price = $fetch_price['gross_price'];
	if($check_balance_qty != 0){

		if($sales_id == 0){
			$add = mysqli_query($conn,"INSERT INTO tbl_sales_order SET status = 0, date_added = '$date_added'") or die(mysqli_error($conn));
			$new_sales_id = mysqli_insert_id($conn);
			if($add){
			

				$add_detail = mysqli_query($conn,"INSERT INTO tbl_sales_order_detail SET quantity = quantity + 1, sales_order_id = '$new_sales_id', product_id = '$products', status = 0, date_added = '$date_added', selling_price = '$cur_price', gross_price='$gross_price'") or die(mysqli_error($conn));
				if($add_detail){
					echo $new_sales_id;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
		}else{
			$check = mysqli_num_rows(mysqli_query($conn,"SELECT sales_order_id FROM tbl_sales_order_detail WHERE sales_order_id = '$sales_id' AND product_id = '$products'"));
			if($check == 0){
				$add_detail = mysqli_query($conn,"INSERT INTO tbl_sales_order_detail SET quantity = quantity + 1, sales_order_id = '$sales_id', product_id = '$products', status = 0, date_added = '$date_added', selling_price = '$cur_price', gross_price='$gross_price'") or die(mysqli_error($conn));
				if($add_detail){
					echo $sales_id;
				}else{
					echo 0;
				}
			}else{
				$add_detail = mysqli_query($conn,"UPDATE tbl_sales_order_detail SET quantity = quantity + 1 WHERE sales_order_id = '$sales_id' AND product_id = '$products'") or die(mysqli_error($conn));
				if($add_detail){
					echo $sales_id;
				}else{
					echo 0;
				}
			}
		}

	}else{
		echo -1;
	}

?>