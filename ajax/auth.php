<?php
	include '../core/config.php';
	session_start();
	$uname = $_POST["uname"];
	$pass = md5($_POST["pass"]);

	$get_user_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_users WHERE username = '$uname' AND password = '$pass'"));

	if($uname == $get_user_data["username"] && $pass == $get_user_data["password"]){
		if( $get_user_data["role"] == '3'){
			echo 2;
		}else{
			$_SESSION["in"] = 1;
			$_SESSION["role"] = $get_user_data["role"];
			$_SESSION["name"] = $get_user_data["name"];
			$_SESSION["uid"] = $get_user_data["user_id"];
			echo 1;
		}
		
	}else{
		echo 0;
	}

?>