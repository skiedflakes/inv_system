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
    <h1 class="h2"> <span class="text-muted">Equipment Report</span></h1>
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
    <div class="col-12 mb-3">
      <form class="row" id="form_generate">
        <div class="col-2  offset-2 text-right h5 p-0 pt-2">Date: </div>
        <div class="col-2"><input type="date" class="form-control" name="as_of_date" value="<?=date('Y-m-d')?>"></div>
        <div class="col-2"><button type="submit" class="btn btn-primary"><i class="fa fa-sync-alt"></i> Generate</button></div>
      </form>
      <hr>
    </div>

    <div class="col-12 report-container">
      <h3 class="col-6 offset-3">Equipment  Report as of <span id="to-date"><?=date('Y-m-d')?></span></h3>
      <div class="table-responsive">
        <table id="tbl_inventory_report" class="table table-striped table-bordered table-sm text-center">
          <thead>
            <tr>
            <th width="15">#</th>
              <th scope="col">Report</th>
              <th scope="col">Reported by</th>
              <th scope="col">Product</th>
              <th scope="col">Engine Number</th>
              <th scope="col">Location</th>
              <th scope="col">position</th>
              <th scope="col">Date added</th>
              <th scope="col">Date updated</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
         
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
    equipment_report("<?=date('Y-m-d')?>");
  });

  function equipment_report(asOfDate){
    $("#tbl_inventory_report").DataTable().destroy();
    $("#tbl_inventory_report").dataTable({
      "ajax": {
        "type": "POST",
        "url": "../ajax/datatables/equipment_report_data.php",
        "data":{asOfDate: asOfDate}
      },
      "processing": true,
      "columns": [ {
        "data": "equipment_report_id"
      },
        {
        "data": "report_detail"
      },
      {
        "data": "name"
      },
      {
        "data": "product_name"
      },
      {
        "data": "engine_no"
      },
      {
        "data": "location"
      },
      {
        "data": "position"
      },
      {
        "data": "date_added"
      },
      {
        "data": "date_updated"
      },
      {
        "data": "status"
      },  
      {
        "mRender": function(data, type, row){
          if(row.status=='assessed'){
            return "<div class='dropdown' style='margin-right:20px'><button class='btn btn-sm btn-outline-dark'>Action</button> <div class='dropdown-content'  style='z-index: 1001; position: fixed;'> <a onclick='Delete("+row.equipment_report_id+")'>Delete</a></div></div>";

          }else{
            return "<div class='dropdown' style='margin-right:20px'><button class='btn btn-sm btn-outline-dark'>Action</button> <div class='dropdown-content'  style='z-index: 1001; position: fixed;'><a onclick='Assessed("+row.equipment_report_id+")'>Assess</a><a onclick='Delete("+row.equipment_report_id+")'>Delete</a></div></div>";
    
          }
        }
      }
      ],
    });
  }

  function Assessed(equipment_report_id){
    swal("Are you sure you want to Assess?", {
    buttons: ["Oh noez!", "Aww yiss!"],
    buttons: true,
    }).then((assess) => {
    if (assess) {
      var url = "../ajax/equipment_report_update.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {equipment_report_id: equipment_report_id},
      success: function(data){

      if(data==1){
        swal("Success status changed to Assessed", {
            icon: "success",
            });
            equipment_report("<?=date('Y-m-d')?>");
      }else if(data==2){
        swal("Please Update Equipment status in supplies module", {
          icon: "warning",
            });
      
      }else {
        swal("Failed", {
          icon: "warning",
            });
      }

      }
    });
       
    } else {
      
    }
    });
  }

  function Delete(equipment_report_id){
    swal("Are you sure you want to delete?", {
    buttons: ["Oh noez!", "Aww yiss!"],
    buttons: true,
    }).then((assess) => {
    if (assess) {
        
      var url = "../ajax/equipment_report_delete.php";
    $.ajax({
      type: "POST",
      url: url,
      data: {equipment_report_id: equipment_report_id},
      success: function(data){

      if(data==1){
        swal("Success status changed to Assessed", {
            icon: "success",
            });
            equipment_report("<?=date('Y-m-d')?>");
      }else{
        swal("Failed", {
          icon: "warning",
            });
      }

      }
    });
    } else {
      
    }
    });
  }

  function edit_user(use_id){
   
  }


  $("#form_generate").submit( function(e){
    e.preventDefault();
    var date = $("input[name=as_of_date]").val();
    equipment_report(date);
  });

</script>