<?php
	include '../core/config.php';
	session_start();
	$qr_code = $_REQUEST["qr_code"];

	$get_user_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_users WHERE username = '$uname' AND password = '$pass'"));
    $response["data"] = array();
	if($uname == $get_user_data["username"] && $pass == $get_user_data["password"]){

        $list["status"] = "1";
		array_push($response["data"], $list);
        echo json_encode($response);
	}else{
        $list["status"] = "0";
		array_push($response["data"], $list);
        
	echo json_encode($response);
	}

  



?>