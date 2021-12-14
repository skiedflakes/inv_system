<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> <span class="text-muted">Category</span></h1>
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
     <?php if($_SESSION["role"] == 0||$_SESSION["role"] == 1){?>
      <div class="btn-group mb-3 float-right">
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#add_product">Add</button>
        <button class="btn btn-sm btn-outline-danger" onclick="delete_product()">Delete</button>
      </div>  <?php } ?>
      <div class="table-responsive">
        <table id="tbl_products" class="table table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th width="15"><input type="checkbox" id="checkCategory" onclick="checkAll()"></th>
              <th width="15">#</th>
              <th>Category Name</th>
              <?php if($_SESSION["role"] == 0||$_SESSION["role"] == 1){?> <th width="100">Action</th> <?php } ?>   
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add new Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="add_product_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Category Name</label>
              <input type="text" name="name" class="form-control" placeholder="Equipment Name">
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

<div class="modal fade" id="edit_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_product_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Category Name</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Equipment Name">
              <input type="hidden" name="category_id" id="category_id">
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
    get_products(<?php echo $_SESSION['role']?>);
  });

  function checkAll(){
    var x = $("#checkCategory").is(":checked");

    if(x){
      $("input[name=cb_product]").prop("checked", true);
    }else{
      $("input[name=cb_product]").prop("checked", false);
    }
  }

  function get_products(val){
    if(val==2){
      $("#tbl_products").DataTable().destroy();
    $("#tbl_products").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/category_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.category_id+"' name='cb_product'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "categeory_name"
      }
      ]

    });
    }else{
      $("#tbl_products").DataTable().destroy();
    $("#tbl_products").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/category_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.category_id+"' name='cb_product'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "categeory_name"
      },
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-outline-dark' onclick='edit_product("+row.category_id+")'>Edit Category</button>";
        }
      }
      ]

    });
    }
  
  }

  $("#add_product_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/category_add.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! New Category was added.");
          $("#add_product").modal("hide");
          $("input").val("");
          $("input[type=checkbox]").prop("checked", false);
          $("textarea").val("");
          get_products(1);
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function edit_product(category_id ){
    var url = "../ajax/category_details.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {category_id : category_id },
      success: function(data){
        $("#edit_product").modal();
        var o = JSON.parse(data);
        $("#name").val(o.name);
        $("#category_id").val(category_id);
      }
    });
  }

  $("#edit_product_form").submit( function(e){
    e.preventDefault();
    var x = $("#is_vatable").is(":checked");
    var is_vatable = x?1:0;

    var x = $("#is_discountable").is(":checked");
    var is_discountable = x?1:0;

    var data = $(this).serialize()+"&is_vatable="+is_vatable+"&is_discountable="+is_discountable;
    var url = "../ajax/category_edit.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! Category was updated.");
          $("#edit_product").modal("hide");
          $("input").val("");
          $("textarea").val("");
          get_products(1);
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function delete_product(){
    var conf = confirm("Are you sure to delete selected?");
    if(conf){
      var prod_id = [];

      $("input[name=cb_product]:checked").each( function(){
        prod_id.push($(this).val());
      });

      if(prod_id.length != 0){

        var url = "../ajax/category_delete.php";

        $.ajax({
          type: "POST",
          url: url,
          data: {prod_id: prod_id},
          success: function(data){
            if(data != 0){
              alert("Success! Selected Category/s was deleted.");
              get_products(1);
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
