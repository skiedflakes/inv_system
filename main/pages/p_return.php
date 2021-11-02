<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><span class="text-muted">Sales Return</span></h1>
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
      <div class="btn-group mb-3 float-right">
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#add_purchase_return">Add</button>
        <button class="btn btn-sm btn-outline-danger" onclick="delete_purchase_return()">Delete</button>
      </div>
      <div class="table-responsive">
        <table id="tbl_purchase_return" class="table table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th width="15"><input type="checkbox" id="checkPurchaseReturn" onclick="checkAll()"></th>
              <th width="15">#</th>
              <th width="150">Transaction Date</th>
              <th>Reference Number</th>
              <th>Product</th>
              <th width="200">Returned Quantity</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_purchase_return" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add new Sales Return</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_purchase_return_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Reference No.</label>
              <select class="custom-select d-flex" name="sales_id" id ="sales_id" style="width:100%;" onchange="get_sales_details()">
               <option value="0">Select Reference No:</option>
                <?php 
                  $products = mysqli_query($conn,"SELECT * FROM `tbl_sales_order` a INNER JOIN tbl_sales_order_detail b WHERE a.receipt_no != '' AND a.sales_order_id = b.sales_order_id AND b.quantity != b.returned_quantity GROUP BY a.receipt_no");
                  while($row = mysqli_fetch_array($products)){
                ?>
                  <option value="<?php echo $row['sales_order_id'];?>"><?php echo $row['receipt_no'];?></option>
                <?php } ?>
              </select>
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Product</label>
              <select class="custom-select d-flex" name="sales_detail_id" id ="product_id" style="width:100%;" disabled="">
               <option value="0">Select Product:</option>
              </select>
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Returned Qty.</label>
              <input type="number" step="1" min="1" name="returned_qty" class="form-control" placeholder="Returned Quantity">
            </div>
            <div class="col-12 p-0">
              <hr>
              <div class="float-right pr-2">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>  
              </div>
            </div>
          </div>      
        </form>
      </div>
    </div>
  </div>
</div>

<!-- PAGE SCRIPT -->
<script type="text/javascript">
  $(document).ready( function(){
    get_purchase_return();
    $('.custom-select').select2();
  });

  function checkAll(){
    var x = $("#checkPurchaseReturn").is(":checked");

    if(x){
      $("input[name=cb_purchase]").prop("checked", true);
    }else{
      $("input[name=cb_purchase]").prop("checked", false);
    }
  }

  function get_purchase_return(){
    $("#tbl_purchase_return").DataTable().destroy();
    $("#tbl_purchase_return").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/purchase_return_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.sales_detail_id+"' name='cb_purchase'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "date_added"
      },
      {
        "data": "receipt_no"
      },
      {
        "data": "product"
      },
      {
        "data": "returned_quantity"
      }
      ]

    });
  }

  $("#add_purchase_return_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/purchase_return_add.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! New Sales return was added.");
          $("#add_purchase_return").modal("hide");
          $("input").val("");
          $("select").val(0).trigger('change');
          get_purchase_return();
        }else if(data == 2){
          alert("Warning! Returned quantity is over than sold quantity.");
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function get_sales_details(){
    var sales_id = $("#sales_id").val();
    if(sales_id != 0){
      var url = "../ajax/sales_return_details.php";
      $.ajax({
        type: "POST",
        url: url,
        data: {sales_id: sales_id},
        success: function(data){
          $("#product_id").prop("disabled", false);
          $("#product_id").html(data);
        }
      });
    }else{
      $("#product_id").prop("disabled", true);
    }
  }

  function delete_purchase_return(){
    var conf = confirm("Are you sure to delete selected?");
    if(conf){
      var sales_detail_id = [];

      $("input[name=cb_purchase]:checked").each( function(){
        sales_detail_id.push($(this).val());
      });

      if(sales_detail_id.length != 0){

        var url = "../ajax/purchase_return_delete.php";

        $.ajax({
          type: "POST",
          url: url,
          data: {sales_detail_id: sales_detail_id},
          success: function(data){
            if(data != 0){
              alert("Success! Selected Purchase return was deleted.");
              get_purchase_return();
            }else{
              alert("Error: "+data);
            }
          }
        });
      }else{
        alert("Warning! No data selected.");
      }
    }
  }

</script>