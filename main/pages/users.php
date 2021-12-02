<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> <span class="text-muted">Users</span></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="h5 mr-5">
        <i class="fa fa-user mr-1"></i> Welcome: <?=$_SESSION["name"];?> <?php if($_SESSION["role"]==0){echo "(Super Admin)";}else if($_SESSION["role"]==1){echo "(Property Personnel)";}else if($_SESSION["role"]==2){echo "(Laboratory Staff)";} ?>
      </div>
      <div class="h5">
        <i class="far fa-calendar mr-1"></i> <?=date("F d, Y");?>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-12">
    <?php if($_SESSION["role"] == 0){?>
      <div class="btn-group mb-3 float-right">
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#add_user">Add</button>
        <button class="btn btn-sm btn-outline-danger" onclick="delete_user()">Delete</button>
      </div>    <?php } ?>
      <div class="table-responsive">
        <table id="tbl_suppliers" class="table table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th width="15"><input type="checkbox" id="checkSupplier" onclick="checkAll()"></th>
              <th width="15">#</th>
              <th  width="100">Name</th>
              <th  width="100">User No.</th>
              <th  width="100">User Level</th>
              <th  width="100">Position</th>
              <th  width="100">Status</th>
              <?php if($_SESSION["role"] == 0){?> <th width="100">Action</th> <?php } ?>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus"></i> Add new User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_user_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Full Name</label>
              <input type="text" name="full_name" class="form-control" placeholder="Full Name">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Username</label>
              <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Confirm Password</label>
              <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
            </div>
           
         
            <div  class="col-8 offset-2 mb-3">
              <label>User Level</label>
               <select class="custom-select d-flex" name="user_role" id ="user_role" style="width:100%;">
               <option value="0">Admin</option>
                      <option value="1">Property Personnel</option>
                      <option value="2">Laboratory Staff</option>
                      <option value="3">Faculty/Mobile User</option>
              </select>
            </div>


            <div  class="col-8 offset-2 mb-3">
              <label>Position</label>
              <input type="text" name="position" class="form-control" placeholder="Position">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>User No</label>
              <input type="text" name="user_no" class="form-control" placeholder="User No">
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

<div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_user_form">
        <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Full Name</label>
              <input type="text" name="e_full_name"  id="e_full_name"class="form-control" placeholder="Full Name">
              <input type="hidden" name="e_user_id" id="e_user_id">
            </div>
         
            <div  class="col-8 offset-2 mb-3">
              <label>User Level</label>
               <select class="custom-select d-flex" name="e_user_role" id ="e_user_role" style="width:100%;">
                      <option value="0">Admin</option>
                      <option value="1">Property Personnel</option>
                      <option value="2">Laboratory Staff</option>
                      <option value="3">Faculty/Mobile User</option>
              </select>
            </div>

            <div  class="col-8 offset-2 mb-3">
              <label>User Status</label>
               <select class="custom-select d-flex" name="e_status" id ="e_status" style="width:100%;">
                      <option value="Active">Active</option>
                      <option value="In-active">In-active</option>
              </select>
            </div>


            <div  class="col-8 offset-2 mb-3">
              <label>Position</label>
              <input type="text" id="e_position" name="e_position" class="form-control" placeholder="Position">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>User No</label>
              <input type="text" name="e_user_no" id="e_user_no" class="form-control" placeholder="User No">
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
    get_users(<?php echo $_SESSION['role']; ?>);
  });

  function checkAll(){
    var x = $("#checkSupplier").is(":checked");

    if(x){
      $("input[name=cb_user]").prop("checked", true);
    }else{
      $("input[name=cb_user]").prop("checked", false);
    }
  }

  function get_users(val){
    if(val>0){   $("#tbl_suppliers").DataTable().destroy();
    $("#tbl_suppliers").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/users_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.user_id+"' name='cb_user'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "name"
      }, {
        "data": "user_no"
      }, {
        "data": "role"
      }, {
        "data": "position"
      }, {
        "data": "status"
      }
      ]

    });}else{
      $("#tbl_suppliers").DataTable().destroy();
    $("#tbl_suppliers").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/users_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.user_id+"' name='cb_user'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "name"
      }, {
        "data": "user_no"
      }, {
        "data": "role"
      }, {
        "data": "position"
      }, {
        "data": "status"
      },
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-outline-dark' onclick='edit_user("+row.user_id+")' >Edit User</button>";
        }
      }
      ]

    });
    }
 
  }

  $("#add_user_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/users_add.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! New User was added.");
          $("#add_user").modal("hide");
          $("input").val("");
          get_users(0);
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function edit_user(use_id){
    var url = "../ajax/users_details.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {use_id: use_id},
      success: function(data){
        var o = JSON.parse(data);
        $("#edit_user").modal();
        $("#e_user_id").val(o.user_id);
        $("#e_full_name").val(o.name);
        $("#e_user_role").val(o.role).trigger('change');
        $("#e_position").val(o.position);
        $("#e_user_no").val(o.user_no);
        $("#e_status").val(o.status).trigger('change');
        
        // $("#e_user_no").val(o.user_number);
      }
    });
  }

  $("#edit_user_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    console.log(data);
    var url = "../ajax/users_edit.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! User was updated.");
          $("#edit_user").modal("hide");
          $("input").val("");
          get_users(0);
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function delete_user(){
    var conf = confirm("Are you sure to delete selected?");
    if(conf){
      var use_id = [];

      $("input[name=cb_user]:checked").each( function(){
        use_id.push($(this).val());
      });
      if(use_id.length != 0){
        var url = "../ajax/users_delete.php";

        $.ajax({
          type: "POST",
          url: url,
          data: {users_id: use_id},
          success: function(data){
          
            if(data != 0){
              alert("Success! Selected User/s was deleted.");
              get_users(0);
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