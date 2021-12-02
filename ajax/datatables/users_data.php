<?php
	include '../../core/config.php';

	$data = mysqli_query($conn,"SELECT * FROM tbl_users");
	$response["data"] = array();
	$count = 1;
	while($row = mysqli_fetch_array($data)){
		$list = array();
		$list["count"] = $count++;
		$list["user_id"] = $row["user_id"];
		$list["user_no"] = $row["user_no"];
        $list["name"] = $row["name"];
        $list["position"] = $row["position"];
        if( $row["role"]==0){
            $list["role"] ="Admin";
        }else  if( $row["role"]==1) {
            $list["role"] ="Property Personnel";
        }else  if( $row["role"]==2){
            $list["role"] ="Laboratory Staff";
        }else{
            $list["role"] ="Mobile User";
        }
        $list["status"] = $row["status"];
		array_push($response["data"], $list);
	}

	echo json_encode($response);

?>