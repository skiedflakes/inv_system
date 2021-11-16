<?php
	include '../core/config.php';
	$user_id = $_POST["users_id"];

	$count = 0;
	foreach ($user_id as  $val) {
		$delete = mysqli_query($conn,"DELETE FROM tbl_users WHERE user_id = '$val'") or die(mysql_error());
		if($delete){
			$count += 1;
		}else{
			$count += 0;
		}
        echo $val;
	}



?>