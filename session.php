<?php
include('config.php');
session_start();
$db = db_open();
$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db,"select id from emp where id = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,$db);

$login_session = $row['id'];

if(!isset($_SESSION['login_user'])){
	header("location:login.php");
}
?>
