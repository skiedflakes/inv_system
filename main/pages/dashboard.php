<div class="main">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
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
    <div class="col-md-4">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Products</strong>
          <h3 class="mb-0" id="prod-digit">0</h3>
        </div>
        <div class="col-auto d-none d-lg-block">
          <div class="bg-primary logo">
            <h1>
              <i class="fa fa-cubes"></i>
            </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Sales</strong>
          <h3 class="mb-0" id="sales-digit">0</h3>
        </div>
        <div class="col-auto d-none d-lg-block">
          <div class="bg-success logo">
            <h1>
              <i class="fa fa-shopping-cart"></i>
            </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-warning">Customers</strong>
          <h3 class="mb-0" id="cust-digit">0</h3>
        </div>
        <div class="col-auto d-none d-lg-block">
          <div class="bg-warning logo">
            <h1>
              <i class="fa fa-users"></i>
            </h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5">Monthly Sales</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
    </div>
  </div>
  <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="1076" height="454" style="display: block; width: 1076px; height: 454px;"></canvas>
</div>

<!-- PAGE SCRIPT -->
<script type="text/javascript">

  function animateValue(obj, start, end, duration) {
  let startTimestamp = null;
  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp;
    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
    obj.innerHTML = Math.floor(progress * (end - start) + start);
    if (progress < 1) {
      window.requestAnimationFrame(step);
    }
  };
  window.requestAnimationFrame(step);
}

const obj = document.getElementById("prod-digit");
animateValue(obj, 1, 1000, 3000);

const obj1 = document.getElementById("sales-digit");
animateValue(obj1, 1, 1000, 3000);

const obj2 = document.getElementById("cust-digit");
animateValue(obj2, 1, 1000, 3000);
  
(function () {
  'use strict'

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Week 1',
        'Week 2',
        'Week 3',
        'Week 4',
      ],
      datasets: [{
        data: [
          10,
          5,
          110,
          50,
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
})()
</script>