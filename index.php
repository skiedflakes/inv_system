<?php
	
	include 'core/config.php';
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Gateway Garden Cafe</title>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/icons/css/all.min.css">
		<style type="text/css">

			.card-container.card {
			    max-width: 350px;
			    padding: 40px 40px;
			}

			.btn {
			    font-weight: 700;
			    height: 36px;
			    -moz-user-select: none;
			    -webkit-user-select: none;
			    user-select: none;
			    cursor: default;
			}

			/*
			 * Card component
			 */
			.card {
			    background-color: #F7F7F7;
			    /* just in case there no content*/
			    padding: 20px 25px 30px;
			    margin: 0 auto 25px;
			    margin-top: 50px;
			    /* shadows and rounded borders */
			    -moz-border-radius: 2px;
			    -webkit-border-radius: 2px;
			    border-radius: 2px;
			    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			}

			.profile-img-card {
			    width: 96px;
			    height: 96px;
			    margin: 0 auto 10px;
			    display: block;
			    -moz-border-radius: 50%;
			    -webkit-border-radius: 50%;
			    border-radius: 50%;
			}

			/*
			 * Form styles
			 */
			.profile-name-card {
			    font-size: 16px;
			    font-weight: bold;
			    text-align: center;
			    margin: 10px 0 0;
			    min-height: 1em;
			}

			.reauth-email {
			    display: block;
			    color: #404040;
			    line-height: 2;
			    margin-bottom: 10px;
			    font-size: 14px;
			    text-align: center;
			    overflow: hidden;
			    text-overflow: ellipsis;
			    white-space: nowrap;
			    -moz-box-sizing: border-box;
			    -webkit-box-sizing: border-box;
			    box-sizing: border-box;
			}

			.form-signin #inputEmail,
			.form-signin #inputPassword {
			    direction: ltr;
			    height: 44px;
			    font-size: 16px;
			}

			.form-signin input[type=email],
			.form-signin input[type=password],
			.form-signin input[type=text],
			.form-signin button {
			    width: 100%;
			    display: block;
			    margin-bottom: 10px;
			    z-index: 1;
			    position: relative;
			    -moz-box-sizing: border-box;
			    -webkit-box-sizing: border-box;
			    box-sizing: border-box;
			}

			.form-signin .form-control:focus {
			    border-color: rgb(104, 145, 162);
			    outline: 0;
			    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
			    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
			}

			.btn.btn-signin {
			    /*background-color: #4d90fe; */
			    /*background-color: rgb(104, 145, 162);*/
			    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
			    padding: 0px;
			    font-weight: 700;
			    font-size: 14px;
			    height: 36px;
			    -moz-border-radius: 3px;
			    -webkit-border-radius: 3px;
			    border-radius: 3px;
			    border: none;
			    -o-transition: all 0.218s;
			    -moz-transition: all 0.218s;
			    -webkit-transition: all 0.218s;
			    transition: all 0.218s;
			}
		</style>

		<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>

		<main role="main" class="container">
		    <div class="container">
		        <div class="card card-container">
		        	<div class="text-center h3 mb-4">Gateway Garden Cafe  <i class="fa fa-mug-hot" style="color: 'gray'">  </i></div>

		            <form id="formLogin">
		            	<div class="input-group mb-2">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
						  </div>
		                  <input type="text" id="uname" name="uname" class="form-control" placeholder="Username" required autofocus>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
						  </div>
						  <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
						</div>
		                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
		            </form><!-- /form -->
		        </div><!-- /card-container -->
		    </div><!-- /container -->
		</main>
	</body>
</html>

<script type="text/javascript">
	$("#formLogin").submit( function(e){
		e.preventDefault();
		$(".btn-signin").prop("disabled", true);
		$(".btn-signin").html("<i class='fa fa-spinner fa-pulse'></i> Signing in...");

		var data = $(this).serialize();
		setTimeout( function(){
			$.ajax({
				type: "POST",
				url: "ajax/auth.php",
				data: data,
				success: function(data){
					if(data == 1){
						alert("Success! Press okay to continue...");
						window.location="main/index.php?page=<?=page_url('products')?>";
					}else{
						alert("Error: Username or password incorrect.");
						$(".btn-signin").prop("disabled", false);
						$(".btn-signin").html("Sign in");
					}
				}
			});
		},2000);
	});
</script>