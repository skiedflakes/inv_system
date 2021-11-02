<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="index.php?page=<?=page_url('dashboard')?>">Dashboard</a> / <span class="text-muted">Stocks</span></h1>
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
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#add_stock">Add</button>
        <button class="btn btn-sm btn-outline-danger" onclick="delete_stocks()">Delete</button>
      </div>
      <div class="table-responsive">
        <table id="tbl_stocks" class="table table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th width="15"><input type="checkbox" id="checkStock" onclick="checkAll()"></th>
              <th width="15">#</th>
              <th>Product</th>
              <th>Supplier</th>
              <th width="100">Quantity</th>
              <th width="100">Unit Cost</th>
              <th width="100">LOT No</th>
              <th width="100">Expiry Date</th>
              <th width="100">Date Entry</th>
              <th width="100">Actions</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add stocks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_stock_form" method="POST" action="#">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Product</label>
               <select class="custom-select d-flex" name="mproduct" id ="mproduct" style="width:100%;">
               <option value="0">Select Product:</option>
                   <?php 
                      $products = mysqli_query($conn,"SELECT * FROM tbl_products");
                      while($row = mysqli_fetch_array($products)){
                    ?>
                      <option 
                    value="<?php echo $row['product_id'];?>"><?php echo $row['brand_name'].", ".$row['generic_name'];?></option>
                    <?php } ?>
              </select>
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Supplier</label>
              <select class="custom-select d-flex" id="supplier_id" style="width:100%;">
                 <option value="0">Select Supplier:</option>
                     <?php 
                        $supplier = mysqli_query($conn,"SELECT * FROM tbl_supplier");
                        while($row = mysqli_fetch_array($supplier)){
                      ?>
                        <option 
                      value="<?php echo $row['supplier_id'];?>"><?php echo $row['supplier_name']?></option>
                      <?php } ?>
                </select>
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Quantity</label>
              <input type="number" name="mquantity" id = "mquantity" class="form-control" placeholder="Quantity">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Unit Cost</label>
              <input type="number" name="cost_price" id = "cost_price" class="form-control" placeholder="Unit Cost" step=".01">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Expiry</label>
              <input id="expiry_date" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div  class="col-8 offset-2 mb-3">
              <label>LOT Number</label>
              <input type="text" name="lot_no" id = "lot_no" class="form-control" placeholder="LOT Number">
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

<div class="modal fade" id="edit_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit Quantity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_stock_form" method="POST" action="#">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Product</label>
              <select class="custom-select d-flex" name="product" id="e_product" style="width:100%;">
               <option value="0">Select Product:</option>
                   <?php 
                      $products = mysqli_query($conn,"SELECT * FROM tbl_products");
                      while($row = mysqli_fetch_array($products)){
                    ?>
                      <option 
                    value="<?php echo $row['product_id'];?>"><?php echo $row['brand_name'].", ".$row['generic_name'];?></option>
                    <?php } ?>
              </select>
              <input type="hidden" name="stock_id" id="stock_id">
            </div>

            <div class="col-8 offset-2 mb-3">
              <label>Supplier</label>
              <select class="custom-select d-flex" name="supplier" id="e_supplier" style="width:100%;">
                 <option value="0">Select Supplier:</option>
                     <?php 
                        $supplier = mysqli_query($conn,"SELECT * FROM tbl_supplier");
                        while($row = mysqli_fetch_array($supplier)){
                      ?>
                        <option 
                      value="<?php echo $row['supplier_id'];?>"><?php echo $row['supplier_name']?></option>
                      <?php } ?>
                </select>
            </div>
       
            <div  class="col-8 offset-2 mb-3">
              <label>Quantity</label>
              <input type="text" name="updated_qty" id="updated_qty" class="form-control">
              <input type="hidden" name="remaining_qty" id="remaining_qty">
              <input type="hidden" name="sold_qty" id="sold_qty">
            </div>
            
            <div  class="col-8 offset-2 mb-3">
              <label>Unit Cost</label>
              <input type="number" name="cost_price" id = "e_cost_price" class="form-control" placeholder="Unit Cost" step=".01">
            </div>

            <div  class="col-8 offset-2 mb-3">
              <label>Expiry</label>
              <input type="date" name="expiry_date" id="e_expiry_date" class="form-control">
            </div>

            <div  class="col-8 offset-2 mb-3">
              <label>LOT Number</label>
              <input type="text" name="lot_no" id = "e_lot_no" class="form-control" placeholder="LOT Number">
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
    get_stocks();
    $('.custom-select').select2();
  });

  function checkAll(){
    var x = $("#checkStock").is(":checked");

    if(x){
      $("input[name=cb_stock]").prop("checked", true);
    }else{
      $("input[name=cb_stock]").prop("checked", false);
    }
  }

  function get_stocks(){
    $("#tbl_stocks").DataTable().destroy();
    $("#tbl_stocks").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/stocks_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.stock_id+"' name='cb_stock'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "product"
      },
      {
        "data": "supplier_name"
      },
      {
        "data": "remaining_qty"
      },
      {
        "data": "cost_price"
      }, {
        "data": "lot_no"
      },
      {
        "data": "expiry_date"
      },
      {
        "data": "date_added"
      },
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-outline-dark' onclick='edit_stock("+row.stock_id+")'>Edit Quantity</button>";
        }
      }
      ]

    });
  }

  $("#add_stock_form").submit( function(e){
    e.preventDefault();
    var product_id = $('#mproduct').val();
    var supplier_id = $('#supplier_id').val();
    var quantity = $('#mquantity').val();
    var cost_price = $('#cost_price').val();
    var expiry_date = $('#expiry_date').val();
    var lot_no = $('#lot_no').val();

    if(product_id!=0&supplier_id!=0&quantity!=''&expiry_date!=''){
      $.ajax({
          url: "../ajax/stocks_add.php",
          type: "post",
          data: {product_id: product_id, supplier_id: supplier_id, quantity: quantity, expiry_date: expiry_date, cost_price: cost_price,lot_no:lot_no},
          success: function (data) {
            if(data == 1){
              alert("Success! New Product Stocks was added.");
              $("#add_stock").modal("hide");
              $("input").val("");
              $("textarea").html("");
              $("select").val(0).trigger('change');
              get_stocks();
            }else{
              alert("Error: "+data);
              $("#add_stock").modal("hide");
              $("input").val("");
              $("textarea").html("");
              $("select").val(0).trigger('change');
            }
          }
      });
    }else{
      alert('Please complete required fields');
    }
 
   
  });

  function edit_stock(stock_id){
    var url = "../ajax/stocks_details.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {stock_id: stock_id},
      success: function(data){
        $("#edit_stock").modal();
        var o = JSON.parse(data);
        $('#stock_id').val(o.stock_id);
        $('#e_product').val(o.product_id).trigger('change');
        $('#e_supplier').val(o.supplier_id).trigger('change');
        $('#e_cost_price').val(o.cost_price);
        $('#e_lot_no').val(o.lot_no);
        $('#e_expiry_date').val(o.expiry_date);
        $('#updated_qty').val(o.quantity-o.sold_quantity);
        $('#remaining_qty').val(o.quantity-o.sold_quantity);
        $('#sold_qty').val(o.sold_quantity);
      }
    });
  }

  $("#edit_stock_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/stocks_edit.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! Product Stocks was updated.");
          $("#edit_stock").modal("hide");
          $("input").val("");
          $("textarea").html("");
          get_stocks();
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function delete_stocks(){
    var conf = confirm("Are you sure to delete selected?");
    if(conf){
      var stock_id = [];
      $("input[name=cb_stock]:checked").each( function(){
        stock_id.push($(this).val());
      });

      if(stock_id.length != 0){

        var url = "../ajax/stocks_delete.php";

        $.ajax({
          type: "POST",
          url: url,
          data: {stock_id: stock_id},
          success: function(data){
            if(data != 0){
              alert("Success! Selected Product Stocks was deleted.");
              get_stocks();
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