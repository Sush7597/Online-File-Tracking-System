<?php
include('config.php');
session_start();
$db = db_open();
$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,$db);

$login_session = $row['username'];

if(!isset($_SESSION['login_user'])){
	header("location:login.php");
}
?>