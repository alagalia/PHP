<?php
require_once "check_index_usage.php";
$host='localhost';
$user='root';
$pass='';
$database='blog';
$conn = mysqli_connect($host,$user,$pass);
$db = mysqli_select_db($conn,$database);
include_once 'encoding.php';
$salt = 'ty3/v+YHWq^[XXdH';

if(!$db)
{
	die(mysqli_error($conn));
}
else
{
	//echo 'OK OK OK';
}
?>