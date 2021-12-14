<?php
   if($page == page_url('products')){
    $dashboard = "";
    $sales = "";
    $products = "active";
    $suppliers = "";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $category = "";
  }else if($page == page_url('suppliers')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "active";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $category = "";
  }else if($page == page_url('stocks')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "";
    $users = "";
    $stocks = "active";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $category = "";
  }else if($page == page_url('customers')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "active";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $category = "";
  }else if($page == page_url('sales_report')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "active";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $category = "";
  }
  else if($page == page_url('inventory_report')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "active";
    $user_logs = "";
    $equipment_report = "";
    $category = "";
  }else if($page == page_url('p_return')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $p_return = "active";
    $s_return = "";
    $category = "";
  }
  else if($page == page_url('location')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "active";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $p_return = "";
    $s_return = "";
    $category = "";
  } else if($page == page_url('users')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "";
    $users = "active";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $p_return = "";
    $s_return = "";
    $category = "";
  }else if($page == page_url('user_logs')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "active";
    $equipment_report = "";
    $p_return = "";
    $s_return = "";
    $category = "";
  }else if($page == page_url('equipment_report')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "active";
    $p_return = "";
    $s_return = "";
    $category = "";
  }else if($page == page_url('category')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $category = "active";
    $location = "";
    $users = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $user_logs = "";
    $equipment_report = "";
    $p_return = "";
    $s_return = "";
  }
?>
 <div class="sidebar-sticky pt-3">
  	<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>navigation</span>
    </h6>
    <ul class="nav flex-column">

        <li class="nav-item">
          <a class="nav-link h6 <?=$users?>" href="index.php?page=<?=page_url('users')?>">
            <span class="fa fa-users"></span>
            Users
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link h6 <?=$category?>" href="index.php?page=<?=page_url('category')?>">
            <span class="fa fa-bars"></span>
            Category
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link h6 <?=$products?>" href="index.php?page=<?=page_url('products')?>">
            <span class="fa fa-cubes"></span>
            Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link h6 <?=$suppliers?>" href="index.php?page=<?=page_url('suppliers')?>">
            <span class="fa fa-truck-moving"></span>
            Brand
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link h6 <?=$location?>" href="index.php?page=<?=page_url('location')?>">
            <span class="fa fa-location-arrow"></span>
            Locations
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link h6 <?=$stocks?>" href="index.php?page=<?=page_url('stocks')?>">
              <span class="fa fa-file-alt"></span>
              Supplies
          </a>
        </li>

    </ul>

  
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>reports</span>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
         <a class="nav-link h6 <?=$inv_report?>" href="index.php?page=<?=page_url('inventory_report')?>">
            <span class="fa fa-archive"></span>
            Inventory Report
          </a>
        </li>
      </ul>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
         <a class="nav-link h6 <?=$user_logs?>" href="index.php?page=<?=page_url('user_logs')?>">
            <span class="fa fa-address-card"></span>
           User Logs
          </a>
        </li>
      </ul>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
         <a class="nav-link h6 <?=$equipment_report?>" href="index.php?page=<?=page_url('equipment_report')?>">
         <span class="badge badge-pill badge-danger">
           <?php

            $conn = mysqli_connect("localhost","root", "",'inv_system');
            date_default_timezone_set("Asia/Manila");
            $sql = mysqli_query($conn,"SELECT * FROM `tbl_equipment_report` where status = 'pending'");
            $row = mysqli_num_rows($sql);
            echo $row;
   
         
            ?>
         </span>
            Equipment Report 
          </a>
        </li>
      </ul>

</div>