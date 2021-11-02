<?php
  $sales_id = isset($_GET['sales_id'])?$_GET["sales_id"]:0;
  $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_sales_order WHERE sales_order_id = '$sales_id'"));
?>
<div class="main">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="index.php?page=<?=page_url('sales')?>">Sales</a> / <span class="text-muted">Print Receipt</span></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="h5 mr-5">
        <i class="fa fa-user mr-1"></i> Welcome: <?=$_SESSION["name"];?>
      </div>
      <div class="h5">
        <i class="far fa-calendar mr-1"></i> <?=date("F d, Y");?>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-12">
      <a href="index.php?page=<?=page_url('sales')?>" class="btn btn-outline-primary mb-3"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="col-12">
      <div class="container">
        <div class="btn-group col-2 offset-9 mb-3">
          <button type="button" class="btn btn-outline-success" onclick="print_receipt()"><i class="fa fa-print"></i> Print</button>
        </div>
        <div id="receipt_container" class="row">
            <div class="well col-10 offset-1">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <address>
                            <strong>COFFEE PROJECT</strong>
                         
                          <p>
                              <em>Receipt #: <?=$data["receipt_no"]?></em>
                          </p>
                        </address>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>
                            <em>Date: <?=date("F d, Y", strtotime($data["date_added"]))?></em>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center font-weight-bolder">
                      Order Slip
                    </div>
                    </span>
                    <table width="100%">
                  
                            <?php

                             if( $data["is_discounted"]=='1'){
                               ?>
                                     <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th >Price</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                               <?php

                                $total_qty = 0;
                                $sub_total = 0;
                                $total_vat = 0;
                                $vatable=0;
                                $vat_exempt=0;
                                $total_discount = 0;
                                $cash_tendered = $data["cash_tendered"];
                                $details_sql = mysqli_query($conn, "SELECT *, SUM(quantity)-sum(returned_quantity) as qty FROM tbl_sales_order_detail WHERE sales_order_id = '$sales_id' GROUP BY product_id");
                                while($row = mysqli_fetch_array($details_sql)){
                                $p_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_products WHERE product_id = '$row[product_id]'"));
                                $discount = $p_data["is_discountable"] == 1 && $data["is_discounted"] == 1?$p_data["gross_price"]*.20:0;
                                $vat = 0;
                                $vat_per_item = $vat*$row["qty"];
                                $price = $p_data["gross_price"];
                                $total_qty +=$row["qty"];
                                $total_price_sum = $row["qty"] * ($price);
                                $total_vat += $vat*$row["qty"];
                                $vatable +=$p_data["is_vatable"] == 1?$row["qty"]*$row["gross_price"]:0;
                                $vat_exempt +=$p_data["is_vatable"] == 0?$row["qty"]*$row["gross_price"]:0;
                                $discount_per_item = $discount*$row["qty"];
                                $sub_total += $total_price_sum;
                                $total_discount += $discount*$row["qty"];
                                $grand_total = $sub_total + $total_vat- $total_discount;
                                $change = $cash_tendered - $grand_total;

                                ?>
                                <tr>
                                    <td> </td>
                                    <td class="prod"><?=$p_data["brand_name"];?></td>
                                    <td class="prod">X <?=$row["qty"];?></td>
                                  <td class="text-center"><?=number_format($total_price_sum+ $vat_per_item,2)?></td>
                                </tr>
                              <?php 
                             }?>
                             
                             <tr>
                                <td colspan="3" class="text-right">
                                <br/>
                                <!-- <p>
                                     Amt of Sale EXEMPT ITEMS:
                                  </p> -->
                                
                                  <!-- <p >
                                    Amt of Sale with VAT:
                                  </p>
                                 -->
                                  <p>
                                     Total Amount:
                                  </p>

                                  <p>
                                    Less 12 % VAT
                                  </p>

                                  <p>
                                    Price Net of VAT
                                  </p>
                              
                              
                                  <p>
                                    LESS 20% Sales Discount:
                                  </p>
                                </td>
                                <td class="text-center">
                                <br/>
                                <!-- <p>
                                    <?=number_format($vat_exempt,2)?>
                                  </p>
                                 
                                  <p>
                                    <?=number_format($vatable/1.12,2)?>
                                  </p> -->
                                  <p>
                                    <?=number_format($vatable+$vat_exempt,2)?>
                                  </p>

                                  <p>
                                    <?=number_format($vatable-($vatable/1.12),2)?>
                                  </p>

                                  <p>
                                    <?=number_format($vatable-($vatable-($vatable/1.12))+$vat_exempt,2)?>
                                  </p>
                               
                                  <p>
                                    <?=number_format(($vatable-($vatable-($vatable/1.12))+$vat_exempt)*0.2,2)?>
                                  </p>
                                </td>
                            </tr>
                            <br/>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                                <td class="text-center text-danger"><strong><u><?=number_format(($vatable-($vatable-($vatable/1.12))+$vat_exempt)-($vatable-($vatable-($vatable/1.12))+$vat_exempt)*0.2,2)?></u></strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">
                                <br/>
                                    <p>
                                       AMOUNT TENDERED CASH :
                                    </p>  <br/>
                                    <p>
                                        <strong>Change:</strong>
                                    </p>
                                </td>
                                <td class="text-center">
                                <br/>
                                  <p>
                                    <?=number_format($cash_tendered,2)?>
                                  </p>  <br/>
                                  <p>
                                    <?=number_format($cash_tendered-(($vatable-($vatable-($vatable/1.12))+$vat_exempt)-($vatable-($vatable-($vatable/1.12))+$vat_exempt)*0.2),2)?>
                                  </p>
                                </td>
                            </tr>
                             <?php
                            
                            
                            
                            }else{

                              ?>
                              <thead>
                     <tr>
                      
                         <th>Product</th>
                       
                         <th class="text-right">Total</th>
                     </tr>
                 </thead>
                 <tbody>
                        <?php
                                $total_qty = 0;
                                $total_with_vat_items=0;
                                $sub_total = 0;
                                $total_vat = 0;
                                $vatable=0;
                                $vat_exempt=0;
                                $total_discount = 0;
                                $vat_per_item=0;
                                $cash_tendered = $data["cash_tendered"];
                                $details_sql = mysqli_query($conn, "SELECT *, SUM(quantity)-sum(returned_quantity) as qty FROM tbl_sales_order_detail WHERE sales_order_id = '$sales_id' GROUP BY product_id");
                                while($row = mysqli_fetch_array($details_sql)){
                                $p_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_products WHERE product_id = '$row[product_id]'"));
                                $discount = $p_data["is_discountable"] == 1 && $data["is_discounted"] == 1?$row["selling_price"]*.20:0;
                                $vat = $p_data["is_vatable"] == 1?$row["selling_price"]*.12:0;
                                $vat_per_item = $vat*$row["qty"];
                                $price = $row["selling_price"];
                                $gprice = $row["gross_price"];
                                $total_qty +=$row["qty"];
                                $total_price_sum = $row["qty"] * ($price+ - $discount);
                                $total_vat += $vat*$row["qty"];
                                $vatable +=$p_data["is_vatable"] == 1?($row["qty"]*$row["selling_price"])/1.12:0;
                                $total_with_vat_items +=$p_data["is_vatable"] == 1?($row["qty"]*$row["selling_price"]):0;
                                $vat_exempt +=$p_data["is_vatable"] == 0?$row["qty"]*$row["selling_price"]:0;

                                $sub_total += $total_price_sum;
                                $total_discount += $discount;
                                $grand_total = $sub_total ;
                                $change = $cash_tendered - $grand_total;

                                  ?>
                                      <tr>
                              
                                  <td class="prod"><?=$p_data["brand_name"];?> X<?=$row["qty"];?> @<?=number_format($price,2)?></td>
                                
                                  <td class="text-right"><?=number_format($total_price_sum,2)?></td>
                              </tr>
                                  <?php


                              }
                            ?>
                              <tr>
                                <td colspan="1" class="text-right"><strong>Total Amount:</strong></td>
                                <td class="text-right"><strong><?=number_format($grand_total,2)?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="1" class="text-right"> <br/>
                                    <p>
                                        <strong>Amount Tendered Cash:</strong>
                                    </p>
                                    <p>
                                        <strong>Total Payment Change:</strong>
                                    </p>
                                </td>
                                <td class="text-right"> <br/>
                                  <p>
                                    <?=number_format($cash_tendered,2)?>
                                  </p>
                                  <p>
                                    <?=number_format($change,2)?>
                                  </p>
                                </td>
                            </tr>
                          
                          
                            <?php
                            
                            }
                            ?>
                          
                     
                        
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-center">Please ask for an Official Receipt. Thank you!</div>
            </div>
        </div>
    </div>
  </div>

</div>


<!-- PAGE SCRIPT -->
<script type="text/javascript">
  $(document).ready( function(){
    
  });
  function print_receipt(){
    var mywindow = window.open('', 'PRINT');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"><link rel="stylesheet" href="../assets/icons/css/all.min.css"><style type="text/css">@media print { body, #receipt_container, table, h5, h1 { margin: 0; font-size:60;font-family:Franklin Gothic} address, em, .prod { font-size60; font-family:Franklin Gothic} }</style></head><body >');
    mywindow.document.write(document.getElementById("receipt_container").innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    setTimeout( function(){
      mywindow.print();
      mywindow.close();
    },200);

    return true;
  }

</script>
