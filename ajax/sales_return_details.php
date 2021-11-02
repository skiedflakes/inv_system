<?php

	include '../core/config.php';
	$sales_id = $_POST["sales_id"];

?>
<option value="0">Select Product:</option>
<?php 
  $products = mysqli_query($conn,"SELECT *, quantity-returned_quantity as new_qty FROM tbl_sales_order_detail WHERE sales_order_id = '$sales_id' AND quantity != returned_quantity");
  while($row = mysqli_fetch_array($products)){
?>
  <option value="<?php echo $row['sales_order_detail_id'];?>"><?php echo get_product_name($row['product_id'],$conn)." - ".$row['new_qty'];?></option>
<?php } ?>