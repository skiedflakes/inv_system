<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> <span class="text-muted">Sales</span></h1>
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
      <div class="row">

        <div class="col-8 p-2">
          <div class="col-12 card pb-2">
            <div class="row p-2">
              <label class="h5">Product</label>
              <input type="hidden" id="sales_id" value="0">
              <select class="form-control" name="mproduct" id="products" onchange="add_sales()">
                <option value="0">Select Product:</option>
                  <?php 
                    $customer = mysqli_query($conn,"SELECT * FROM tbl_products");
                    while($row = mysqli_fetch_array($customer)){
                  ?>
                    <option value="<?php echo $row['product_id'];?>"><?php echo $row['brand_name'].", ".$row['generic_name'];?></option>
                  <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-4 p-2">
          <div class="col-12 card pb-2">
            <div class="row p-2">
              <label class="h5">Customer</label>
               <select class="custom-select d-flex" name="mproduct" id="customers" style="width:100%;" onchange="get_customer()">
               <option value="0">Select Customer:</option>
                   <?php 
                      $customer = mysqli_query($conn,"SELECT * FROM tbl_customers");
                      while($row = mysqli_fetch_array($customer)){
                    ?>
                      <option 
                    value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_name'];?></option>
                    <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-8 p-2">
          <div class="col-12 card pt-3 pb-3">
            <div class="table-responsive">
              <table id="tbl_sales" class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col" width="10"></th>
                    <th scope="col" width="10">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col" width="100">Qty</th>
                    <th scope="col" width="100">VAT</th>
                    <th scope="col" width="100">Total</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-4 p-2">
          <div class="col-12 card pt-3">
            <div class="row p-2">
              <div class="col-6 text-center h6">
                Sales Person:
              </div>
              <div class="col-6 text-center h6 font-weight-bold">
                <?=$_SESSION["name"]?>
                <input type="hidden" id="cashier" value="<?=$_SESSION['uid']?>">
              </div>
              <div class="col-12">
                <hr>
              </div>
              <div class="col-12 mb-3">
                <button type="button" class="btn btn-danger btn-block btn-cancel" style="display: none;" onclick="cancel_sales()"><i class="fa fa-ban"></i> Cancel Sales</button>
              </div>
              <div class="col-6 h5 pl-3 mb-2">
                Total:
              </div>
              <div class="col-6 h5 pl-3 mb-2">
                Amount Due:
              </div>
              <div class="col-6 text-center h5 card-header mb-2 total_amt">0</div>
              <div class="col-6 text-center h5 card-header mb-2 total_due">0.00</div>
              <div class="col-12">
                <label><b>Discount</b></label>
                <br>
                <label><input type="checkbox" class="discount" onclick="add_discount()"> Senior</label>
                <br>
                <label><input type="checkbox" class="discount" onclick="add_discount()"> PWD</label>
              </div>
              <div class="col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Cash: </span>
                  </div>
                  <input type="text" class="form-control" id="cash_amount" placeholder="Enter Cash Amount" onkeyup="get_total_due()">
                  <input type="hidden" id="total_due_amount" value="0">
                  <input type="hidden" class="total_amount" value="0">
                </div>
              </div>
              <div class="col-12 mb-3">
                <button type="button" class="btn btn-success btn-block btn-complete" onclick="complete_sales()"><i class="fa fa-check"></i> Complete Sale</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- PAGE SCRIPT -->
<script type="text/javascript">
  $(document).ready( function(){
    $("#products").select2();
    $("#customers").select2();
    get_sales(0,0);
    get_customer();

    is_completed(0);
  });

  function get_sales(sales_id,disc){
    $("#tbl_sales").DataTable().destroy();
    $("#tbl_sales").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/sales_data.php",
        "data": {sales_id : sales_id, disc : disc}
      },
      "processing": true,
      "ColumnDefs": [
        { "sortable": false},
      ],
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-danger' onclick='remove_product("+row.sales_detail_id+")'><i class='fa fa-times-circle'></i></button>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "product_name"
      },
      {
        "data": "product_price"
      },
      {
        "mRender": function(data, type, row){
          return "<input type='number' class='form-control' min='1' id='prod_qty"+row.sales_detail_id+"' onkeyup='add_prod_qty("+row.sales_detail_id+")' value='"+row.quantity+"'>";
        }
      },
      {
        "data": "vat"
      },
      {
        "mRender": function(data, type, row){
          var sum = parseFloat(row.product_price).toFixed(2)*row.quantity;
          return "<div class='font-weight-bold'>"+sum.toFixed(2)+"</div> <input type='hidden' name='prod_sum' value='"+sum+"'>";
        }
      }
      ],
      "initComplete": function(settings, json) {
        get_total();
      }

    });
  }

  function get_disc_sales(sales_id,disc){
    $("#tbl_sales").DataTable().destroy();
    $("#tbl_sales").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/sales_data_disc.php",
        "data": {sales_id : sales_id, disc : disc}
      },
      "processing": true,
      "ColumnDefs": [
        { "sortable": false},
      ],
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-danger' onclick='remove_product("+row.sales_detail_id+")'><i class='fa fa-times-circle'></i></button>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "product_name"
      },
      {
        "data": "product_price"
      },
      {
        "mRender": function(data, type, row){
          return "<input type='number' class='form-control' min='1' id='prod_qty"+row.sales_detail_id+"' onkeyup='add_prod_qty("+row.sales_detail_id+")' value='"+row.quantity+"'>";
        }
      },
      {
        "data": "vat"
      },
      {
        "mRender": function(data, type, row){
          var sum = parseFloat(row.product_price).toFixed(2)*row.quantity;
          return "<div class='font-weight-bold'>"+sum.toFixed(2)+"</div> <input type='hidden' name='prod_sum' value='"+sum+"'>";
        }
      }
      ],
      "initComplete": function(settings, json) {
        get_total();
      }

    });
  }

  function add_sales(){
    var products = $("#products").val();
    var sales_id = $("#sales_id").val();
    var url = "../ajax/sales_add.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {sales_id: sales_id, products: products},
      success: function(data){
        if(data != 0){
          if(data == -1){
            alert("Warning, Not enough remaining stocks");
          }else{
            $("#products").val(0);
            $("#sales_id").val(data);
            get_sales(data,0);
          }
        }else{
          alert("Error: "+data);
        }
      }
    });
  }

  function remove_product(sales_id){
    var url = "../ajax/sales_delete_detail.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {sales_id: sales_id},
      success: function(data){
        if(data != 0){
          get_sales(data,0);
        }else{
          alert("Error: "+data);
        }
      }
    });
  }

  function add_prod_qty(sales_id){
    var prod_qty = $("#prod_qty"+sales_id).val();

    var url = "../ajax/sales_add_qty.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {sales_id: sales_id, prod_qty: prod_qty},
      success: function(data){
        if(data != 0){
          get_sales(data,0);
        }else{
          alert("Error: "+data);
        }
      }
    });
  }

  function get_total(){
    var prod_sum = [];

    $("input[name=prod_sum]").each( function(){
      prod_sum.push($(this).val());
    });

    var total = prod_sum.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
    $(".total_amt").html(total.toFixed(2));
    $(".total_amount").val(total);
    $("#total_due_amount").val(total);

  }

  function get_total_due(){
    var cash = $("#cash_amount").val();
    var due = $("#total_due_amount").val();

    if(cash==due){
      var total =0;


$(".total_due").html(total.toFixed(2));

    }else{
      var total = (cash*1) - (due*1);


$(".total_due").html(total.toFixed(2));

    }

  }

  function get_customer(){
    var customer = $("#customers").val();
    var prod_sum = [];

    $("input[name=prod_sum]").each( function(){
      prod_sum.push($(this).val());
    });

    if(customer == 0 || prod_sum.length == "" || prod_sum.length == 0){
      $(".btn-complete").prop("disabled", true);
      $("#cash_amount").prop("disabled", true);
      $("input[type=checkbox]").prop("disabled", true);
      $(".btn-cancel").hide();
    }else{
      $(".btn-complete").prop("disabled", false);
      $("#cash_amount").prop("disabled", false);
      $("input[type=checkbox]").prop("disabled", false);
      $(".btn-cancel").show();
    }
  }

  function add_discount(){
    var get_disc = $(".discount").is(":checked");
    var disc = get_disc?1:0;
    var sales_id = $("#sales_id").val();
    if(get_disc){
      get_disc_sales(sales_id, disc);
    }else{
      get_sales(sales_id, disc);
    }
  
  }

  function complete_sales(){
    var total = $(".total_amount").val();
    var sales_id = $("#sales_id").val();
    var customer = $("#customers").val();
    var cashier = $("#cashier").val();
    var is_discounted = $(".discount").is(":checked")?1:0;
    var cash_tendered = $("#cash_amount").val();
    var url = "../ajax/sales_complete_transaction.php";

    if(cash_tendered*1 >= total*1){
      $.ajax({
        type: "POST",
        url: url,
        data: {sales_id: sales_id, cashier: cashier, customer: customer, is_discounted: is_discounted, cash_tendered: cash_tendered},
        success: function(data){
          if(data == 1){
            alert("Success! Sales Completed.");
            is_completed(1);
            window.location.href="index.php?page=<?=page_url('receipt')?>&sales_id="+sales_id;
          }else{
            alert("Failed! Something went wrong or insufficient stocks.");
          }
        }
      });
    }else{
      alert("Warning! Insufficient cash tendered.");
    }
  }

  function cancel_sales(){
    var sales_id = $("#sales_id").val();
    var url = "../ajax/sales_cancel_transaction.php";
    var x = confirm("Are you sure to cancel transaction?");

    if(x){
      $.ajax({
        type: "POST",
        url: url,
        data: {sales_id: sales_id},
        success: function(data){
          if(data == 1){
            alert("Success! Sales Canceled.");
            is_completed(1);
          }else{
            alert("Error: "+data);
          }
        }
      });
    }
  }

  function is_completed(reload){
    if(reload == 0){
      $(window).on('beforeunload', function(){
        return "";
      });
    }else{
      $(window).unbind('beforeunload');
      window.location.reload();
    }
  }
</script>