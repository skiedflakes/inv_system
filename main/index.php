<?php
	include '../core/config.php';
	session_start();

	
	$page = isset($_GET['page'])&&$_GET['page']!=""?$_GET['page']:"404";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>INVENTORY SYSTEM</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/core.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/icons/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="../assets/css/select2.min.css"/>
		<style type="text/css">
			body {
			  font-size: .875rem;
			}

			.feather {
			  width: 16px;
			  height: 16px;
			  vertical-align: text-bottom;
			}

			/*
			 * Sidebar
			 */

			.sidebar {
			  position: fixed;
			  top: 0;
			  bottom: 0;
			  left: 0;
			  z-index: 100; /* Behind the navbar */
			  padding: 48px 0 0; /* Height of navbar */
			  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
			}

			@media (max-width: 767.98px) {
			  .sidebar {
			    top: 5rem;
			  }
			}

			.sidebar-sticky {
			  position: relative;
			  top: 0;
			  height: calc(100vh - 48px);
			  padding-top: .5rem;
			  overflow-x: hidden;
			  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
			}

			@supports ((position: -webkit-sticky) or (position: sticky)) {
			  .sidebar-sticky {
			    position: -webkit-sticky;
			    position: sticky;
			  }
			}

			.sidebar .nav-link {
			  font-weight: 500;
			  color: #333;
			}

			.sidebar .nav-link .feather {
			  margin-right: 4px;
			  color: #999;
			}

			.sidebar .nav-link.active {
			  color: #007bff;
			}

			.sidebar .nav-link:hover .feather,
			.sidebar .nav-link.active .feather {
			  color: inherit;
			}

			.sidebar-heading {
			  font-size: .75rem;
			  text-transform: uppercase;
			}

			/*
			 * Navbar
			 */

			.navbar-brand {
			  padding-top: .75rem;
			  padding-bottom: .75rem;
			  font-size: 1rem;
			  font-weight: bold;
			}

			.navbar .navbar-toggler {
			  top: .25rem;
			  right: 1rem;
			}

			.navbar .form-control {
			  padding: .75rem 1rem;
			  border-width: 0;
			  border-radius: 0;
			}

			.form-control-dark {
			  color: #fff;
			  background-color: rgba(255, 255, 255, .1);
			  border-color: rgba(255, 255, 255, .1);
			}

			.form-control-dark:focus {
			  border-color: transparent;
			  box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
			}
			.logo{
				width: 125px;
			    height: 110px;
			    padding: 40px;
			    padding-top: 30px;
			}
		</style>

		<script type="text/javascript" src="../assets/js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript" src="../assets/js/popper.js"></script>
		<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../assets/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="../assets/js/Chart.min.js"></script>
		<script type="text/javascript" src="../assets/js/select2.min.js"></script>

	</head>
	<body>		
		<nav class="navbar navbar-light sticky-top flex-md-nowrap p-0 shadow" style="background-color: black;">
		  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="dashboard.php"><h4 style="margin-bottom: 0;
    font-weight: bold;color: white">INVENTORY SYSTEM <i class="fa fa-mug-hot" style="color: gray;"></i></h4></a>
		  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <ul class="navbar-nav px-3 font-weight-bold">
		    <li class="nav-item text-nowrap">
		      <a class="nav-link" href="#" onclick="logout()" style="color:white;"><i class="fa fa-sign-out"></i> Sign out</a>
		    </li>
		  </ul>
		</nav>

		<div class="container-fluid">
		  <div class="row">
		    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
		    	<?php include 'components/sidenav.php'; ?>
		    </nav>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
		    	<?php include '../core/routes.php'; ?>
		    </main>
		  </div>
		</div>
	</body>
</html>
<!-- GLOBAL SCRIPT -->
<script type="text/javascript">
	function logout(){
		var x = confirm("Are you sure to end your session?");
		if(x){
			window.location="../ajax/logout.php";
		}
	}
</script>