<?php 
include('config.php');
session_start();
ini_set('display_errors',0);
$error="";
$db = db_open();
if($_SERVER["REQUEST_METHOD"] == "POST") {      
	$pass = "1234"; 
	$code = $_POST['code'];
	$depart = $_POST['deprt'];
	$desig = $_POST['desig'];
	$sect = $_POST['sect'];
	$pcon = $_POST['pcon'];
	$result1 =  mysql_query(" Select id from emp WHERE code = '$code' ", $db);
	$count1 = mysql_num_rows($result1);
	if($count1 == 0) {
		$s="INSERT into emp values ('".$code."','".$pass."','".$depart."','".$desig."','".$sect."','".$pcon."')";
		mysql_query( $s,$db);
		$_SESSION['login_user'] = $code;
		header("location: changepassword.php");
	}
	else{
		$error = "Code Already Exists in the Database.";
	}
}
?>
<html>
	<head>
		<title> Sign-up </title>
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
display: inline-block;
float: left;
clear: both;
	text-align: center;
	font-size:14px;
	margin-left : 65px;
	font-family : 'book antique';
}.box 
{
border:#666666 solid 1px;

}

input {
display: inline-block;
float: both;
	font-family : 'book antique';
}
	</style>

	<body>
		<img src = "imgs/logo.png">
			<h3 style= "font-family : 'Arial'; font-size : 20px;"> Central Electronics Limited </h3>
			<h3 style= " font-size : 40px;font-family : 'book antique';"> Sign-up </h3>
			<div align = "center" Style = "text-align : 'left';font-family : 'book antique';">
				<div style = "width:300px; " align = "center">
					<form action = "" method = "post" style="margin-top:5%; " autocomplete = "off">
						<label> Code   : </label>
						<br />
						<input type = "number" name = "code" class = "box" required>
							<br />
							<br />
							<label> Department   : </label>
							<br />
							<input type = "text" name = "deprt" class = "box" required>
								<br />
								<br />
								<label> Designation   : </label>
								<br />
								<input type = "text" name = "desig" class = "box" required>
									<br />
									<br />
									<label> Section   : </label>
									<br />
									<input type = "text" name = "sect" class = "box" required>
										<br />
										<br />
										<label> Person Concerned   : </label>
										<br />
										<input list="Person Concerned" name="pcon" required>
											<datalist id="Person Concerned">
												<option value="GM">GM</option>
												<option value="AGM">AGM</option>
												<option value="ED">ED</option>
												<option value="TO">TO</option>
												<option value="CM">CM</option>
												<option value="CMD">CMD</option>
											</datalist>
											<br />
											<h3 style= "font-family : 'Arial'; font-size : 10px;">Default Password is 1234.Password can be changed after Login.</h3>
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

						