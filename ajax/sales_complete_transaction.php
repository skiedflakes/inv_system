<?php
	include '../core/config.php';
	$sales_id = $_POST["sales_id"];
	$cashier = $_POST["cashier"];
	$customer = $_POST["customer"];
	$is_discounted = $_POST["is_discounted"];
	$cash_tendered = $_POST["cash_tendered"];
	$date_added = date("Y-m-d");
	$data = mysqli_query($conn,"SELECT * FROM tbl_sales_order_detail where sales_order_id = '$sales_id'");
	$count_num = mysqli_num_rows($data);
	$count_added = 0;
	$receipt_no = date("ymdHis");

	while($row = mysqli_fetch_array($data)){
		$sales_order_detail_id = $row['sales_order_detail_id'];
		$product_id = $row['product_id'];
		$stock_id = $row['stock_id'];
		$quantity = $row['quantity'];


		$check_stocks = "SELECT sum(quantity-sold_quantity) remaining_quantity,quantity,sold_quantity FROM `tbl_stocks` where product_id = '$product_id' and quantity!=sold_quantity order by expiry_date ASC";
		$query_count_remaining_stocks = mysqli_query($conn, $check_stocks);
		$total_remaining_stocks = mysqli_fetch_assoc($query_count_remaining_stocks);
		$stock_total_quantity = $total_remaining_stocks['quantity'];
	

		if($total_remaining_stocks['remaining_quantity']>=$quantity){
			$sql = "SELECT stock_id,quantity,sold_quantity FROM `tbl_stocks` where product_id = '$product_id' and quantity!=sold_quantity order by expiry_date ASC";
			$result = mysqli_query($conn, $sql);
			$data2 = mysqli_fetch_assoc($result);
	
			$stocks_remaining_qty = $data2['quantity']- $data2['sold_quantity'];
			$sold_qty = $data2['sold_quantity'];
			$ftotal_qty = $data2['quantity'];
			$fstock_id = $data2['stock_id'];
			if($stocks_remaining_qty>=$quantity){

									$final_sold_qty = $quantity+$sold_qty;
					$update_stocks = mysqli_query($conn,"UPDATE `tbl_stocks` SET `sold_quantity` = '$final_sold_qty' WHERE `tbl_stocks`.`stock_id` = '$fstock_id'");
					$update_sales_order_detail = mysqli_query($conn,"UPDATE `tbl_sales_order_detail` SET `stock_id` = '$fstock_id' WHERE `tbl_sales_order_detail`.`sales_order_detail_id` = '$sales_order_detail_id'");
					if($update_stocks){
						if($update_sales_order_detail){
						

							$count_added++;
							if($count_num==	$count_added){
								$edit = mysqli_query($conn,"UPDATE tbl_sales_order SET user_id = '$cashier', is_discounted = '$is_discounted', cash_tendered = '$cash_tendered', status = 1, receipt_no = '$receipt_no', customer_id = '$customer' WHERE sales_order_id = '$sales_id'") or die(mysqli_error($conn));

								if($edit){	
										echo 1;
								}else{
									echo 0;
								}
							}
						
						}else{
							echo 0;
						}
					
					}else{
						echo 0;
					}
					
			
	
			}else{

				//update current 
				$update_stocks = mysqli_query($conn,"UPDATE `tbl_stocks` SET `sold_quantity` = '$ftotal_qty' WHERE `tbl_stocks`.`stock_id` = '$fstock_id'");
				$update_sales_order_detail = mysqli_query($conn,"UPDATE `tbl_sales_order_detail` SET `stock_id` = '$fstock_id', `quantity` ='$stocks_remaining_qty ' WHERE `tbl_sales_order_detail`.`sales_order_detail_id` = '$sales_order_detail_id'");
			
				if($update_stocks){

					if($update_sales_order_detail){

						$remaining_sold_qty = $quantity-($ftotal_qty-$sold_qty);

					
						$stock_data = mysqli_query($conn,"SELECT * FROM tbl_stocks where product_id = '$product_id' and sold_quantity != quantity order by expiry_date ASC");
						while($row_stock = mysqli_fetch_array($stock_data)){
		
							//create sales order details
							//
							$stock_stock_id = $row_stock['stock_id'];
							$stock_sold_quantity = $row_stock['sold_quantity'];
							$stock_quantity = $row_stock['quantity'];
							$stock_remaining_quantity = $stock_quantity-$stock_sold_quantity;

							if($stock_remaining_quantity>=$remaining_sold_qty){
								$stock_final_quantity = $remaining_sold_qty+$stock_sold_quantity;
								$create_new_sales_order_details = mysqli_query($conn,"INSERT INTO `tbl_sales_order_detail` (`sales_order_detail_id`, `sales_order_id`, `product_id`, `stock_id`, `quantity`, `date_added`, `date_updated`, `status`, `discount`) 
								VALUES (NULL, '$sales_id', '$product_id', '$stock_stock_id', '$remaining_sold_qty', '$date_added', '', '1', '')");
								$update_stocks = mysqli_query($conn,"UPDATE `tbl_stocks` SET `sold_quantity` = '$stock_final_quantity' WHERE `tbl_stocks`.`stock_id` = '$stock_stock_id'");

								if($create_new_sales_order_details){
									if($update_stocks){
										$count_added++;
										$remaining_sold_qty=0;
										if($count_num==	$count_added){
											$edit = mysqli_query($conn,"UPDATE tbl_sales_order SET user_id = '$cashier', is_discounted = '$is_discounted', cash_tendered = '$cash_tendered', status = 1, receipt_no = '$receipt_no', customer_id = '$customer' WHERE sales_order_id = '$sales_id'") or die(mysqli_error($conn));

											if($edit){	
													echo 1;
											}else{
												echo 0;
											}
										}

									}else{
										echo 0;
									}
								
								}else{
									echo 0;
								}
								
							}else{

								$create_new_sales_order_details = mysqli_query($conn,"INSERT INTO `tbl_sales_order_detail` (`sales_order_detail_id`, `sales_order_id`, `product_id`, `stock_id`, `quantity`, `date_added`, `date_updated`, `status`, `discount`) 
								VALUES (NULL, '$sales_id', '$product_id', '$stock_stock_id', '$stock_quantity', '$date_added', '', '', '')");
								$update_stocks = mysqli_query($conn,"UPDATE `tbl_stocks` SET `sold_quantity` = '$stock_quantity' WHERE `tbl_stocks`.`stock_id` = '$stock_stock_id'");

								if($create_new_sales_order_details){
									if($update_stocks){
									
										$remaining_sold_qty=$remaining_sold_qty-$stock_quantity;
									}else{
										echo 0;
									}
								
								}else{
									echo 0;
								}

							}
		
						}

					}else{
						echo 0;
					}
				}else{
					echo 0;
				}
			}
		}else{
			//some stocks are insufficient
			echo 0;
		}

	}


	// $edit = mysqli_query($conn,"UPDATE tbl_sales_order SET user_id = '$cashier', is_discounted = '$is_discounted', cash_tendered = '$cash_tendered', status = 1 WHERE sales_order_id = '$sales_id'") or die(mysqli_error($conn));
	// if($edit){
	// 	echo 1;
	// }else{
	// 	echo 0;
	// }

?>