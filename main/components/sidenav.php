<?php
   if($page == page_url('products')){
    $dashboard = "";
    $sales = "";
    $products = "active";
    $suppliers = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
  }else if($page == page_url('suppliers')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "active";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
  }else if($page == page_url('stocks')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $stocks = "active";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
  }else if($page == page_url('customers')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $stocks = "";
    $customers = "active";
    $sales_report = "";
    $inv_report = "";
  }else if($page == page_url('sales_report')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $stocks = "";
    $customers = "";
    $sales_report = "active";
    $inv_report = "";
  }
  else if($page == page_url('inventory_report')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "active";
  }else if($page == page_url('p_return')){
    $dashboard = "";
    $sales = "";
    $products = "";
    $suppliers = "";
    $stocks = "";
    $customers = "";
    $sales_report = "";
    $inv_report = "";
    $p_return = "active";
    $s_return = "";
  }
?>
 <div class="sidebar-sticky pt-3">
  	<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>navigation</span>
    </h6>
    <ul class="nav flex-column">
      <?php if($_SESSION["role"] == 0){?>
        <li class="nav-item">
          <a class="nav-link h6 <?=$products?>" href="index.php?page=<?=page_url('products')?>">
            <span class="fa fa-cubes"></span>
            Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link h6 <?=$stocks?>" href="index.php?page=<?=page_url('stocks')?>">
              <span class="fa fa-file-alt"></span>
              Stocks
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link h6 <?=$customers?>" href="index.php?page=<?=page_url('customers')?>">
            <span class="fa fa-users"></span>
            Customers
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link h6 <?=$suppliers?>" href="index.php?page=<?=page_url('suppliers')?>">
            <span class="fa fa-truck-moving"></span>
            Suppliers
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link h6 <?=$p_return?>" href="index.php?page=<?=page_url('p_return')?>">
            <span class="fa fa-shopping-basket"></span>
            Sales Return
          </a>
        </li>
       
      <?php } ?>
    </ul>

    <?php if($_SESSION["role"] == 0){?>
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>reports</span>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
         <a class="nav-link h6 <?=$sales_report?>" href="index.php?page=<?=page_url('sales_report')?>">
            <span class="fa fa-chart-bar"></span>
            Sales Report
          </a>
        </li>
        <li class="nav-item">
         <a class="nav-link h6 <?=$inv_report?>" href="index.php?page=<?=page_url('inventory_report')?>">
            <span class="fa fa-archive"></span>
            Inventory Report
          </a>
        </li>
      </ul>
    <?php } ?>
</div>