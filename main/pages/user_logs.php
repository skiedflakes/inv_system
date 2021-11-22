<style>
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}
@media print {
    body.modalprinter * {
        visibility: hidden;
    }

    body.modalprinter .modal-dialog.focused {
        position: absolute;
        padding: 0;
        margin: 0;
        left: 0;
        top: 0;
    }

    body.modalprinter .modal-dialog.focused .modal-content {
        border-width: 0;
    }

    body.modalprinter .modal-dialog.focused .modal-content .modal-header .modal-title,
    body.modalprinter .modal-dialog.focused .modal-content .modal-body,
    body.modalprinter .modal-dialog.focused .modal-content .modal-body * {
        visibility: visible;
    }

    body.modalprinter .modal-dialog.focused .modal-content .modal-header,
    body.modalprinter .modal-dialog.focused .modal-content .modal-body {
        padding: 0;
    }

    body.modalprinter .modal-dialog.focused .modal-content .modal-header .modal-title {
        margin-bottom: 20px;
    }
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}

.printable { display: none; }

@media print
{
    .non-printable { display: none; }
    .printable { display: block; }
}
</style>
<div class="main">
  
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> <span class="text-muted">User Logs</span></h1>
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
              <th>Equipment Name</th>
            
              <th width="100">Engine No.</th>
              <th width="100">Location</th>

              <th width="80">Last User</th>
              <th width="80">Used Date</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade printable autoprint" id="print_qr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-print-none" id="exampleModalLabel"> Print QR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="print_qr" method="POST" action="#">
          <div class="row">
          <div  class="col-8 offset-2" id="qrcode"></div>

            <div class="col-12">
              <hr>
              <div class="float-right pr-2 d-print-none">
                <button type="button" class="btn btn-secondary d-print-none" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary d-print-none" onclick="window.print();">Print</button>
              </div>
            </div>
          </div>      
        </form>
      </div>
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
              <label>Location</label>
              <select class="custom-select d-flex" id="location_id" style="width:100%;">
                 <option value="0">Select Location:</option>
                     <?php 
                        $supplier = mysqli_query($conn,"SELECT * FROM tbl_location");
                        while($row = mysqli_fetch_array($supplier)){
                      ?>
                        <option 
                      value="<?php echo $row['location_id'];?>"><?php echo $row['location_name']?></option>
                      <?php } ?>
                </select>
            </div>

             
            <div  class="col-8 offset-2 mb-3">
              <label>Engine Number</label>
              <input type="text" name="engine_number" id = "engine_number" class="form-control" placeholder="Unit Cost" step=".01">
            </div>
          
            <div  class="col-8 offset-2 mb-3">
              <label>Unit Cost</label>
              <input type="number" name="cost_price" id = "cost_price" class="form-control" placeholder="Unit Cost" step=".01">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Purchase Date</label>
              <input id="expiry_date" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Update Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_stock_form" method="POST" action="#">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Product</label>
              <select class="custom-select d-flex" name="e_product" id="e_product" style="width:100%;">
               <option value="0">Select Product:</option>
                   <?php 
                      $products = mysqli_query($conn,"SELECT * FROM tbl_products");
                      while($row = mysqli_fetch_array($products)){
                    ?>
                      <option 
                    value="<?php echo $row['product_id'];?>"><?php echo $row['brand_name'].", ".$row['generic_name'];?></option>
                    <?php } ?>
              </select>
              <input type="hidden" name="e_stock_id" id="e_stock_id">
            </div>

            <div class="col-8 offset-2 mb-3">
              <label>Supplier</label>
              <select class="custom-select d-flex" name="e_supplier" id="e_supplier" style="width:100%;">
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
              <label>Location</label>
              <select class="custom-select d-flex" name="e_location_id" id="e_location_id" style="width:100%;">
                 <option value="0">Select Location:</option>
                     <?php 
                        $supplier = mysqli_query($conn,"SELECT * FROM tbl_location");
                        while($row = mysqli_fetch_array($supplier)){
                      ?>
                        <option 
                      value="<?php echo $row['location_id'];?>"><?php echo $row['location_name']?></option>
                      <?php } ?>
                </select>
            </div>

            
            <div  class="col-8 offset-2 mb-3">
              <label>Status</label>
              <select class="custom-select d-flex" name="e_status" id="e_status" style="width:100%;">
           
                    <option value="Healthy" style="text-color:green;">Healthy</option>
                    <option value="Malfunctioned" style="text-color:green;">Malfunctioned</option>
                    <option value="Repair" style="text-color:green;">Repair</option>
                   
                </select>
            </div>

         
            <div id="Repair" class="col-8 offset-2 mb-3" style="display:none">
              <label>Schedule for Repair</label>
              <input type="date" name="e_sched_repair" id="e_sched_repair" class="form-control">
            </div>

            <div  class="col-8 offset-2 mb-3">
              <label>Engine Number</label>
              <input type="text" name="e_engine_number" id = "e_engine_number" class="form-control" placeholder="Unit Cost" step=".01">
            </div>

            
            <div  class="col-8 offset-2 mb-3">
              <label>Unit Cost</label>
              <input type="number" name="e_cost_price" id = "e_cost_price" class="form-control" placeholder="Unit Cost" step=".01">
            </div>

            <div  class="col-8 offset-2 mb-3">
              <label>Purchase Date</label>
              <input type="date" name="e_expiry_date" id="e_expiry_date" class="form-control">
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

    $(function() {
        $('#e_status').change(function(){
			
			if($(this).val()=="Repair"){  
				$('#' + $(this).val()).show();
			}else{
				 $('#Repair').hide();
			}
          
        });
    });

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
        "url": "../ajax/datatables/user_logs_data.php",
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
        "data": "engine_number"
      },
      {
        "data": "location_name"
      },
      {
        "data": "last_user"
      },
      {
        "data": "last_used_date"
      }
      ]

    });
  }

  $("#add_stock_form").submit( function(e){
    e.preventDefault();
    var product_id = $('#mproduct').val();
    var supplier_id = $('#supplier_id').val();
    var location_id = $('#location_id').val();
    var cost_price = $('#cost_price').val();
    var expiry_date = $('#expiry_date').val();
    var engine_number = $('#engine_number').val();

    if(product_id!=0&supplier_id!=0&expiry_date!=''){
      $.ajax({
          url: "../ajax/stocks_add.php",
          type: "post",
          data: {product_id: product_id, supplier_id: supplier_id, location_id: location_id, expiry_date: expiry_date, cost_price: cost_price,engine_number:engine_number},
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
        $('#e_stock_id').val(o.stock_id);
        $('#e_product').val(o.product_id).trigger('change');
        $('#e_supplier').val(o.supplier_id).trigger('change');
        $('#e_location_id').val(o.location_id).trigger('change');
        $('#e_status').val(o.status).trigger('change');
        $('#e_engine_number').val(o.engine_number).trigger('change');
        $('#e_cost_price').val(o.cost_price);
        $('#e_expiry_date').val(o.expiry_date);
        $('#e_sched_repair').val(o.date_repair);
      
      }
    });
  }

  function print_qr(stock_id){
    var url = "../ajax/stocks_details.php";
  
    $.ajax({
      type: "POST",
      url: url,
      data: {stock_id: stock_id},
      success: function(data){
        $("#print_qr").modal();
        var o = JSON.parse(data);
        var to_encrpyt = o.stock_id+"-"+o.engine_number;
        var passhash = CryptoJS.MD5(to_encrpyt).toString();
        $("#qrcode").html("");
        var qrc = new QRCode(document.getElementById("qrcode"),passhash);
      }
    });
  }

  $("#edit_stock_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    console.log(data);
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


$().ready(function () {
    $('.modal.printable').on('shown.bs.modal', function () {
        $('.modal-dialog', this).addClass('focused');
        $('body').addClass('modalprinter');

  
    }).on('hidden.bs.modal', function () {
        $('.modal-dialog', this).removeClass('focused');
        $('body').removeClass('modalprinter');
    });
});

</script>
