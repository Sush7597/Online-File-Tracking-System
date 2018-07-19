<!DOCTYPE html>
<?php
include('config.php');
ini_set('display_errors',0);
session_start();
$error="";
$db = db_open();
if($_SERVER["REQUEST_METHOD"] == "POST") {      
	$Code = $_POST['Code'];
	$pass = $_POST['password'];       
	$result = mysql_query( "SELECT * FROM emp WHERE code = '$Code' and password = '$pass'",$db);
	$row = mysql_fetch_array($result);
	$count = mysql_num_rows($result);      		
	if($count == 1) {
		$_SESSION['login_user'] = $Code;
		header("location: home.php?user=$Code");
	}else {
		$error = "Your Login Name or Password is invalid!";
	}
}


?>

<html>
	<head>
		<title> Login </title>
	</head>
	<style>
img 
{	
	width : 83px;
	height : 70px;
	border = 2px;
}

body	
{
	text-align : center;
	margin-left : 10%;
	margin-right : 10%;
	min-width : 80%;
	margin-top : 5%;
	font-family : 'book antique';
}
label 
{
	font-weight:bold;
width:100px;
	font-size:18px;
	font-family : 'book antique';
}.box 
{
border:#666666 solid 1px;
}
	</style>
	<body>
		<img src = "imgs/logo.png">
			<h3 style= "font-family : 'Arial'; font-size : 20px;"> Central Electronics Limited </h3>
			<h3 style= "font-family : 'Arial'; font-size : 40px;font-family : 'book antique';"> Login </h3>

			<form action = "" method = "post" style="margin-top:5%;" autocomplete = "off">
				<label Style = "margin-left : 32px"> Code   : </label>
				<input type = "text" name = "Code" class = "box"    required>
					<br />
					<br />
					<label> Password  :  </label>
					<input type = "password" name = "password" class = "box" required>
						<br/>
						<br />
						<input type = "submit" value = " Submit "/>
						<br />
					</form>

					<div style = "font-size:11px; color:#cc0000; margin-top:10px">
						<?php echo $error; ?>
					</div>
					<h3 style= "font-family : 'Arial'; font-size : 40;">
						<a href = "signup.php"> Create a new account </a>
					</h3>        

				</body>
			</html>