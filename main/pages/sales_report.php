<div class="main">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> <span class="text-muted">Sales Report</span></h1>
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
        <div class="col-1 offset-2 text-right h5 p-0 pt-2">From: </div>
        <div class="col-2"><input type="date" class="form-control" name="from_date" value="<?=date('Y-m-d')?>"></div>
        <div class="col-1 text-right h5 p-0 pt-2">To: </div>
        <div class="col-2"><input type="date" class="form-control" name="to_date" value="<?=date('Y-m-d')?>"></div>
        <div class="col-2"><button type="submit" class="btn btn-primary"><i class="fa fa-sync-alt"></i> Generate</button></div>
      </form>
      <hr>
    </div>

    <div class="col-12 report-container">
      <h3 class="col-6 offset-3">Sales Report from <span id="from-date"><?=date('Y-m-d')?></span> to <span id="to-date"><?=date('Y-m-d')?></span></h3>
      <div class="table-responsive">
        <table id="tbl_sales_report" class="table table-striped table-bordered table-sm text-center">
          <thead>
            <tr>
              <th width="10"></th>
              <th scope="col">Receipt #</th>
              <th scope="col">Transaction Date</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Amount</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot class="bg-light">
            <tr>
              <th colspan="4" class="text-left">TOTAL:</th>
              <th id="total_qty"></th>
              <th id="total_amt"></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

  </div>

</div>

<!-- PAGE SCRIPT -->
<script type="text/javascript">
  $(document).ready( function(){
    sales_report("<?=date('Y-m-d')?>","<?=date('Y-m-d')?>");
  });

  function sales_report(fromDate,toDate){
    $("#tbl_sales_report").DataTable().destroy();
    $("#tbl_sales_report").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/sales_report_data.php",
        "data":{fromDate: fromDate, toDate: toDate}
      },
      "processing": true,
      "columns": [
      {
        "mRender": function(data, type, row){
          return "<button class='btn btn-sm btn-success' onclick='print_sales("+row.sales_id+")'><i class='fas fa-print'></i></button>";
        }
      },
      {
        "data": "receipt_no"
      },
      {
        "data": "trans_date"
      },
      {
        "data": "customer"
      },
      {
        "data": "quantity"
      },
      {
        "data": "amount"
      }
      ],
      "createdRow": function( row, data, dataIndex) {
        if(data.total_quantity && data.amount){
          $("#total_qty").html(data.total_quantity);
          $("#total_amt").html(data.total_amount);
          $("#from-date").html(data.fromDate);
          $("#to-date").html(data.toDate);
        }
      },
      "initComplete": function( settings, json ) {
        var api = this.api();
        if(api.rows().count() == 0){
          $("#total_qty").html(0);
          $("#total_amt").html("0.00");

          var from = $("input[name=from_date]").val();
          var to = $("input[name=to_date]").val();
          $("#from-date").html(from);
          $("#to-date").html(to);
        }
      }

    });
  }

  $("#form_generate").submit( function(e){
    e.preventDefault();
    var from = $("input[name=from_date]").val();
    var to = $("input[name=to_date]").val();
    sales_report(from,to);
  });

  function print_sales(sales_id){
    window.open("index.php?page=<?=page_url('receipt')?>&sales_id="+sales_id, '_blank');
  }

</script>