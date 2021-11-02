<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><span class="text-muted">Customers</span></h1>
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
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#add_customer">Add</button>
        <button class="btn btn-sm btn-outline-danger" onclick="delete_customer()">Delete</button>
      </div>
      <div class="table-responsive">
        <table id="tbl_customers" class="table table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th width="15"><input type="checkbox" id="checkCustomer" onclick="checkAll()"></th>
              <th width="15">#</th>
              <th>Customer Name</th>
              <th>Customer Address</th>
              <th width="100">Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus"></i> Add new Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_customer_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Customer Name</label>
              <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Customer Address</label>
              <textarea class="form-control" name="customer_address" placeholder="type here..."></textarea>
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

<div class="modal fade" id="edit_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_customer_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Customer Name</label>
              <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name">
              <input type="hidden" name="customer_id" id="customer_id">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Customer Address</label>
              <textarea class="form-control" name="customer_address" id="customer_address" placeholder="type here..."></textarea>
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
    get_customers();
  });

  function checkAll(){
    var x = $("#checkcustomer").is(":checked");

    if(x){
      $("input[name=cb_customer]").prop("checked", true);
    }else{
      $("input[name=cb_customer]").prop("checked", false);
    }
  }

  function get_customers(){
    $("#tbl_customers").DataTable().destroy();
    $("#tbl_customers").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/customer_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.customer_id+"' name='cb_customer'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "customer_name"
      },
      {
        "data": "customer_address"
      },
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-outline-dark' onclick='edit_customer("+row.customer_id+")'>Edit Customer</button>";
        }
      }
      ]

    });
  }

  $("#add_customer_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/customer_add.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! New Customer was added.");
          $("#add_customer").modal("hide");
          $("input").val("");
          $("textarea").val("");
          get_customers();
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function edit_customer(customer_id){
    var url = "../ajax/customer_details.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {customer_id: customer_id},
      success: function(data){
        $("#edit_customer").modal();
        var o = JSON.parse(data);
        $("#customer_name").val(o.customer_name);
        $("#customer_address").val(o.customer_address);
        $("#customer_id").val(customer_id);
      }
    });
  }

  $("#edit_customer_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/customer_edit.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! Customer was updated.");
          $("#edit_customer").modal("hide");
          $("input").val("");
          $("textarea").val("");
          get_customers();
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function delete_customer(){
    var conf = confirm("Are you sure to delete selected?");
    if(conf){
      var cust_id = [];

      $("input[name=cb_customer]:checked").each( function(){
        cust_id.push($(this).val());
      });

      if(cust_id.length != 0){

        var url = "../ajax/customer_delete.php";

        $.ajax({
          type: "POST",
          url: url,
          data: {cust_id: cust_id},
          success: function(data){
            if(data != 0){
              alert("Success! Selected Customer/s was deleted.");
              get_customers();
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