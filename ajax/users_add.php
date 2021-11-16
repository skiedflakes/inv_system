<?php
	include '../core/config.php';
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $pass = md5($_POST["password"]);
    $user_role = $_POST["user_role"];
    $position = $_POST["position"];
    $user_no = $_POST["user_no"];
    
    $date_added = date("Y-m-d");

	$add = mysqli_query($conn,"INSERT INTO `tbl_users` (`user_id`, `user_no`, `name`, `position`, `username`, `password`, `role`, `status`) VALUES (NULL, '$user_no', '$full_name', '$position', '$username', '$pass', ' $user_role', 'Active')") or die(mysql_error());
	if($add){
		echo 1;
	}else{
		echo 0;
	}

?>