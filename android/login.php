<?php
	include '../core/config.php';
	session_start();
	$uname = $_REQUEST["username"];
	$pass = md5($_REQUEST["password"]);

	$get_user_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_users WHERE username = '$uname' AND password = '$pass'"));
    $response["data"] = array();
	if($uname == $get_user_data["username"] && $pass == $get_user_data["password"]){
		$list["user_name"] = $get_user_data["user_name"];
		$list["user_id"] = $get_user_data["user_id"];
        $list["status"] = "1";
		array_push($response["data"], $list);
        echo json_encode($response);
	}else{
        $list["status"] = "0";
		array_push($response["data"], $list);
        
	echo json_encode($response);
	}

  



?>