<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> <span class="text-muted">Locations</span></h1>
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
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#add_location">Add</button>
        <button class="btn btn-sm btn-outline-danger" onclick="delete_location()">Delete</button>
      </div>
      <div class="table-responsive">
        <table id="tbl_suppliers" class="table table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th width="15"><input type="checkbox" id="checkSupplier" onclick="checkAll()"></th>
              <th width="15">#</th>
              <th>Location Name</th>
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
<div class="modal fade" id="add_location" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus"></i> Add new Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_location_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Location Name</label>
              <input type="text" name="location_name" class="form-control" placeholder="Supplier Name">
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

<div class="modal fade" id="edit_location" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_location_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Location Name</label>
              <input type="text" name="location_name" id="edit_location_name" class="form-control" placeholder="Location Name">
              <input type="hidden" name="location_id" id="location_id">
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
    get_suppliers();
  });

  function checkAll(){
    var x = $("#checkSupplier").is(":checked");

    if(x){
      $("input[name=cb_supplier]").prop("checked", true);
    }else{
      $("input[name=cb_supplier]").prop("checked", false);
    }
  }

  function get_suppliers(){
    $("#tbl_suppliers").DataTable().destroy();
    $("#tbl_suppliers").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/location_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.location_id+"' name='cb_location'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "location_name"
      },
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-outline-dark' onclick='edit_location("+row.location_id+")'>Edit Location</button>";
        }
      }
      ]

    });
  }

  $("#add_location_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/location_add.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! New location was added.");
          $("#add_location").modal("hide");
          $("input").val("");
          get_suppliers();
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function edit_location(location_id){
    var url = "../ajax/location_details.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {location_id: location_id},
      success: function(data){
        $("#edit_location").modal();
        $("#edit_location_name").val(data);
        $("#location_id").val(location_id);
      }
    });
  }

  $("#edit_location_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/location_edit.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! Supplier was updated.");
          $("#edit_location").modal("hide");
          $("input").val("");
          get_suppliers();
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function delete_location(){
    var conf = confirm("Are you sure to delete selected?");
    if(conf){
      var location_id = [];

      $("input[name=cb_location]:checked").each( function(){
        location_id.push($(this).val());
      });
      if(location_id.length != 0){
        var url = "../ajax/location_delete.php";

        $.ajax({
          type: "POST",
          url: url,
          data: {location_id: location_id},
          success: function(data){
            if(data != 0){
              alert("Success! Selected location was deleted.");
              get_suppliers();
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