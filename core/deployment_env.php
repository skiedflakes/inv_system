<?php
include 'functions.php'
$host 	  = "mysql.hostinger.com";
$username = "u245151288_projects";
$password = "12345";
$database = "u245151288_projects";

$conn= new mysqli($host, $username, $password,$database)or die("Could not connect to mysql".mysqli_error($con));
?>