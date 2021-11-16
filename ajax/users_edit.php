<?php
	include '../core/config.php';
	$user_id = $_POST["e_user_id"];
    $name = $_POST["e_full_name"];
    $role = $_POST["e_user_role"];
    $position = $_POST["e_position"];
    $user_no = $_POST["e_user_no"];
    $status = $_POST["e_status"];
  
    //EDIT DETAILS
    $edit_stock = mysqli_query($conn,"UPDATE `tbl_users` SET `name` = '$name', `position` = '$position', `role` = '$role', `status` ='$status',`user_no` ='$user_no' WHERE `user_id` = '$user_id'") or die(mysql_error());
    
    if($edit_stock){

        echo 1;
    }else{
        echo 0;
    }





?>