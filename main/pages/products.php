<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> <span class="text-muted">Products</span></h1>
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
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#add_product">Add</button>
        <button class="btn btn-sm btn-outline-danger" onclick="delete_product()">Delete</button>
      </div>
      <div class="table-responsive">
        <table id="tbl_products" class="table table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th width="15"><input type="checkbox" id="checkProduct" onclick="checkAll()"></th>
              <th width="15">#</th>
              <th>Brand Name</th>
              <th>Generic Name</th>
              <th>Category / Description</th>
              <th>Selling Price</th>
              <th>Gross Price</th>
              <th width="100">VATable</th>
              <th width="100">Discountable</th>
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
<div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add new Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_product_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Brand Name</label>
              <input type="text" name="brand_name" class="form-control" placeholder="Brand Name">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Generic Name</label>
              <input type="text" name="generic_name" class="form-control" placeholder="Generic Name">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Category / Description</label>
              <textarea class="form-control" name="category_description" placeholder="type here..."></textarea>
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Selling Price</label>
              <input type="number" name="product_price" class="form-control" placeholder="Selling Price" step=".01">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Gross Price</label>
              <input type="number" name="gross_price" class="form-control" placeholder="Gross Price" step=".01">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label><input type="checkbox" name="is_vatable" value="1"> Vatable?</label>
              <br>
              <label><input type="checkbox" name="is_discountable" value="1"> Discountable?</label>
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_product_form">
          <div class="row">
            <div  class="col-8 offset-2 mb-3">
              <label>Brand Name</label>
              <input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="Brand Name">
              <input type="hidden" name="product_id" id="product_id">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Generic Name</label>
              <input type="text" name="generic_name" id="generic_name" class="form-control" placeholder="Generic Name">
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Category / Description</label>
              <textarea class="form-control" name="category_description" id="category_description" placeholder="type here..."></textarea>
            </div>
            <div  class="col-8 offset-2 mb-3">
              <label>Selling Price</label>
              <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Product Price" step=".01">
            </div>

            <div  class="col-8 offset-2 mb-3">
              <label>Gross Price</label>
              <input type="number" name="gross_price" id="gross_price" class="form-control" placeholder="Product Price" step=".01">
            </div>

            <div  class="col-8 offset-2 mb-3">
              <label><input type="checkbox" id="is_vatable" value="1"> Vatable?</label><br>
              <label><input type="checkbox" id="is_discountable" value="1"> Discountable?</label>
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
    get_products();
  });

  function checkAll(){
    var x = $("#checkProduct").is(":checked");

    if(x){
      $("input[name=cb_product]").prop("checked", true);
    }else{
      $("input[name=cb_product]").prop("checked", false);
    }
  }

  function get_products(){
    $("#tbl_products").DataTable().destroy();
    $("#tbl_products").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/product_data.php",
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<input type='checkbox' value='"+row.product_id+"' name='cb_product'>";
        }
      },
      {
        "data": "count"
      },
      {
        "data": "brand_name"
      },
      {
        "data": "generic_name"
      },
      {
        "data": "category_description"
      },
      {
        "data": "price"
      },
      {
        "data": "gross_price"
      },
      {
        "data": "is_vatable"
      },
      {
        "data": "is_discountable"
      },
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-outline-dark' onclick='edit_product("+row.product_id+")'>Edit Product</button>";
        }
      }
      ]

    });
  }

  $("#add_product_form").submit( function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = "../ajax/product_add.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! New Product was added.");
          $("#add_product").modal("hide");
          $("input").val("");
          $("input[type=checkbox]").prop("checked", false);
          $("textarea").val("");
          get_products();
        }else{
          alert("Error: "+data);
        }
      }
    });
  });

  function edit_product(product_id){
    var url = "../ajax/product_details.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {product_id: product_id},
      success: function(data){
        $("#edit_product").modal();
        var o = JSON.parse(data);
        $("#brand_name").val(o.brand_name);
        $("#generic_name").val(o.generic_name);
        $("#category_description").val(o.category_description);
        var product_price = o.price;
        var gross_price = o.gross_price;
        $("#gross_price").val(gross_price);
        $("#product_price").val(product_price);
        var is_vatable = o.is_vatable==1?true:false;
        $("#is_vatable").prop("checked",is_vatable);
        var is_discountable = o.is_discountable==1?true:false;
        $("#is_discountable").prop("checked",is_discountable);
        $("#product_id").val(product_id);
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
    var url = "../ajax/product_edit.php";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(data){
        if(data == 1){
          alert("Success! Product was updated.");
          $("#edit_product").modal("hide");
          $("input").val("");
          $("textarea").val("");
          get_products();
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

        var url = "../ajax/product_delete.php";

        $.ajax({
          type: "POST",
          url: url,
          data: {prod_id: prod_id},
          success: function(data){
            if(data != 0){
              alert("Success! Selected Product/s was deleted.");
              get_products();
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
