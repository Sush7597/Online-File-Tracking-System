<!DOCTYPE html>
<html>
	<head>
		<title> Change Password </title>
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
	margin-top : 5
	font-family : 'book antique';
}
label 
{
	font-weight:bold;
display: inline-block;
float: left;
clear: both;
	text-align: center;
	font-family : 'book antique';
	font-size:14px;
	margin-left : 65px;
}.box 
{
border:#666666 solid 1px;

}

input {
display: inline-block;
float: both;
}
	</style>

	<?php 
include('config.php');
session_start();
ini_set('display_errors',0);
$error="";
$db = db_open();
if($_SERVER["REQUEST_METHOD"] == "POST") {      
	$code = $_POST['code'];
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];

	if($pass == $cpass)
	{	
		$result1=mysql_query("Select code from emp WHERE code = '$code'", $db);
		$count1 = mysql_num_rows($result1);
		if($count1 == 1) {
			mysql_query( "UPDATE emp set password = '$pass' where code = '$code'",$db);
			header("location: home.php?user=$code");
		}else {
			$error = "ID Does not Exists in the Database.";
		}
	}else
	$error = "Passwords doesn't match.";
}

?>

	<body>
		<img src = "imgs/logo.png">
			<h3 style= "font-family : 'Arial'; font-size : 25px;font-family : 'book antique';"> Central Electronics Limited </h3>
			<h3 style= "font-family : 'Arial'; font-size : 40px;font-family : 'book antique';"> Change Password </h3>

			<div align = "center" Style = "text-align : 'left';font-family : 'book antique';">
				<div style = "width:300px; " align = "center">
					<form action = "" method = "post" style="margin-top:5%; ">
						<label> Code   : </label>
						<br />
						<input type = "text" name = "code" class = "box"/>
						<br />
						<br />
						<label> Password   : </label>
						<br />
						<input type = "password" name = "pass" class = "box"/>
						<br />
						<br />
						<label> Confirm Password   : </label>
						<br />
						<input type = "password" name = "cpass" class = "box"/>
						<br />
						<br />
						<input type = "submit" value = " Submit " />
						<br />
					</form>					
				</div>
			</div>
			<div style = "font-size:11px; color:#cc0000; margin-top:10px">
				<?php echo $error; ?>
			</div>
		</body>
	</html>
	