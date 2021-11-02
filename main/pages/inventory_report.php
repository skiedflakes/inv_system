<div class="main">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> <span class="text-muted">Inventory Report</span></h1>
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
    <div class="col-12 mb-3">
      <form class="row" id="form_generate">
        <div class="col-2  offset-2 text-right h5 p-0 pt-2">Date: </div>
        <div class="col-2"><input type="date" class="form-control" name="as_of_date" value="<?=date('Y-m-d')?>"></div>
        <div class="col-2"><button type="submit" class="btn btn-primary"><i class="fa fa-sync-alt"></i> Generate</button></div>
      </form>
      <hr>
    </div>

    <div class="col-12 report-container">
      <h3 class="col-6 offset-3">Inventory Report as of <span id="to-date"><?=date('Y-m-d')?></span></h3>
      <div class="table-responsive">
        <table id="tbl_inventory_report" class="table table-striped table-bordered table-sm text-center">
          <thead>
            <tr>
              <th scope="col">Product Name</th>
              <th scope="col">Price</th>
              <th scope="col">Balance</th>
              <th scope="col">Stock In</th>
              <th scope="col">Stock Out</th>
              <th scope="col">Remaining</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>

  </div>

</div>

<!-- PAGE SCRIPT -->
<script type="text/javascript">
  $(document).ready( function(){
    inventory_report("<?=date('Y-m-d')?>");
  });

  function inventory_report(asOfDate){
    $("#tbl_inventory_report").DataTable().destroy();
    $("#tbl_inventory_report").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/inventory_report_data.php",
        "data":{asOfDate: asOfDate}
      },
      "processing": true,
      "columns": [
      {
        "data": "product_name"
      },
      {
        "data": "price"
      },
      {
        "data": "balance"
      },
      {
        "data": "stock_in"
      },
      {
        "data": "stock_out"
      },
      {
        "data": "remaining_qty"
      }
      ],
      // "createdRow": function( row, data, dataIndex) {
      //   if(data.total_quantity && data.amount){
      //     $("#total_qty").html(data.total_quantity);
      //     $("#total_amt").html(data.total_amount);
      //     $("#from-date").html(data.fromDate);
      //     $("#to-date").html(data.toDate);
      //   }
      // },
      // "initComplete": function( settings, json ) {
      //   var api = this.api();
      //   if(api.rows().count() == 0){
      //     $("#total_qty").html(0);
      //     $("#total_amt").html("0.00");

      //     var from = $("input[name=from_date]").val();
      //     var to = $("input[name=to_date]").val();
      //     $("#from-date").html(from);
      //     $("#to-date").html(to);
      //   }
      // }

    });
  }

  $("#form_generate").submit( function(e){
    e.preventDefault();
    var date = $("input[name=as_of_date]").val();
    inventory_report(date);
  });

</script>