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
            <th width="15">#</th>
              <th scope="col">Product Name</th>
              <th scope="col">Stock in</th>
              <th scope="col">Repair</th>
              <th scope="col">Stock out</th>
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
        "data": "product_id"
      },
      {
        "data": "product_name"
      },
      {
        "data": "stock_in"
      },  {
        "data": "for_repair"
      },    {
        "data": "stock_out"
      },  
      {
        "data": "remaining_stock"
      },
      ],
    });
  }

  $("#form_generate").submit( function(e){
    e.preventDefault();
    var date = $("input[name=as_of_date]").val();
    inventory_report(date);
  });

</script>