<?php

	function page_url($page){
		return md5(base64_encode($page));
	}

	function enCrypt($data){
		return base64_encode($data);
	}

	function deCrypt($data){
		return base64_decode($data);
	}

	function get_customer_name($customer_id, $conn){
		$customer_data = mysqli_fetch_array(mysqli_query($conn, "SELECT customer_name FROM tbl_customers WHERE customer_id = '$customer_id'"));
		return $customer_data[0];
	}

	function get_product_name($product_id, $conn){
		$product_data = mysqli_fetch_array(mysqli_query($conn, "SELECT brand_name, generic_name FROM tbl_products WHERE product_id = '$product_id'"));
		return $product_data[0].", ".$product_data[1];
	}

	function get_detail_amount($sales_id, $conn,$senior){
		$sales_data = mysqli_query($conn, "SELECT * FROM tbl_sales_order a 
		INNER JOIN tbl_sales_order_detail b on a.sales_order_id = b.sales_order_id 
		INNER JOIN tbl_products c on c.product_id = b.product_id 
		where a.sales_order_id = '$sales_id' AND a.status = 1");
		$total_amount = 0;
		$total_vat=0;
		$total_vatable_price=0;
		$total_non_vatable_price=0;
		$total_discount=0;
		$total_price=0;
		while($row = mysqli_fetch_array($sales_data)){
			$discount = $row["is_discountable"] == 1 && $row["is_discounted"] == 1?$row["gross_price"]*.20:0;
	        $price = $row["is_discountable"] == 1 && $row["is_discounted"] == 1? $row["gross_price"]: $row["selling_price"];
			if($row["is_discounted"] == 1){
				$vat =  $row["is_vatable"] == 1? $row["gross_price"]:0;
				$non_vat = $row["is_vatable"] ==0? $row["gross_price"]:0;
			}else{
				$vat =  $row["is_vatable"] == 1? $row["selling_price"]:0;
				$non_vat = $row["is_vatable"] ==0? $row["selling_price"]:0;
			}
		
	        $total_price += ($row["quantity"]-$row["returned_quantity"]) * $price;
	        $total_vatable_price += ($row["quantity"]-$row["returned_quantity"]) * $vat;
			$total_non_vatable_price +=$row["quantity"]* $non_vat;
	        $total_discount += ($row["quantity"]-$row["returned_quantity"]) * $discount;
		}
	
		$total_vat = $total_vatable_price *0.12;
		$total_amount=  $total_vatable_price+$total_non_vatable_price-$total_discount;
		if($senior==1){
			$senior_vatable = $total_vatable_price/1.12;
			$totalvat = $total_vatable_price-$senior_vatable;
			$senior_less_20 = ($total_price - $totalvat) * 0.2;
			$seniorfinal =( $total_price - $totalvat)-$senior_less_20;
			return number_format( $seniorfinal,2); 
		}else{
			return number_format( $total_amount,2); 
		}
		
	

	
	}

	function get_balance_qty($product_id, $date, $conn){
		$get_stock_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(quantity) as qty FROM `tbl_stocks` WHERE date_added <= '$date' AND product_id = '$product_id'"));

		return $get_stock_qty[0]?$get_stock_qty[0]:0;
	}

	function stock_in_qty($product_id, $date, $conn){
		$stock_in_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(quantity) as qty FROM `tbl_stocks` WHERE date_added = '$date' AND product_id = '$product_id'"));

		return $stock_in_qty[0]?$stock_in_qty[0]:0;
	}

	function stock_out_qty($product_id, $date, $conn){
		$stock_out_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(b.quantity)-sum(b.returned_quantity) as qty FROM `tbl_sales_order` a INNER JOIN `tbl_sales_order_detail` b WHERE a.sales_order_id = b.sales_order_id AND a.status = 1 AND b.date_added <= '$date' AND b.product_id = '$product_id'"));

		return $stock_out_qty[0]?$stock_out_qty[0]:0;
	}

	function get_remaining_qty($product_id, $date, $conn){
		$sold_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(b.quantity) - sum(b.returned_quantity) as qty FROM `tbl_sales_order` a INNER JOIN `tbl_sales_order_detail` b WHERE a.sales_order_id = b.sales_order_id AND a.status = 1 AND b.date_added <= '$date' AND b.product_id = '$product_id'"));

		$get_stock_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(quantity) as qty FROM `tbl_stocks` WHERE date_added <= '$date' AND product_id = '$product_id'"));

		$total_remaining_qty = $get_stock_qty[0] - $sold_qty[0];

		return $total_remaining_qty?$total_remaining_qty:0;
	}

	function check_balance_qty($product_id, $conn){
		$get_stock_qty = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(quantity) as qty, sum(sold_quantity) as s_qty FROM `tbl_stocks` WHERE product_id = '$product_id'"));
		$total_qty = $get_stock_qty[0] - $get_stock_qty[1];

		return $total_qty?$total_qty:0;
	}

?>