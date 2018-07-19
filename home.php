<!DOCTYPE html>
<?php
include('session.php');
ini_set('display_errors',0);
$code=$_GET['user'];
$result = mysql_query( "SELECT * FROM emp WHERE code = '$code'",$db);
$row = mysql_fetch_assoc($result);
$depart  = $row['department'];
$desig = $row['designation'];
$sect = $row['section'];

?>
<html>
	<head>
		<title> CEL </title>
		<link rel="stylesheet" type="text/css" href="style.css">
		</head>
		<body>
			<img src = "imgs/logo.png">
				<h3 style= "font-family : 'Arial'; font-size : 38px; align : center;margin-top : -20px"> Central Electronics Limited </h3>
				<h2 style= "position: absolute; top: 0; right: 0;font-size : 20px; margin-right: 15px; margin-top : 20px;">
					<a href = "logout.php" >Sign Out</a>
				</h2>
				<h1 style= "font-family : 'book antique'; font-size : 25px; align : center; margin-top : -15px;"> ONLINE FILE TRACKING SYSTEM </h1>
				<h3 style= "font-family : 'book antique'; font-size : 23px; align : center; margin-top : 30px;">
					<?php echo ucwords($code).", ". ucwords($desig).", ".ucwords($sect).", ". strtoupper($depart) ?>
				</h3>
				<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
					<?php echo date('F d, Y')?>
				</h3>
				<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 50px;">
					<a href = "gen.php?id=<?php echo $code; ?>"> Generate Dak   </a>
					</h3>
					<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
						<a href = "recreq.php?id=<?php echo $code; ?>" > Pending Requests </a>
						</h3>
						<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
							<a href = "recd.php?id=<?php echo $code; ?>" > Received Dak  </a>
							</h3>
							<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
								<a href = "send.php?id=<?php echo $code; ?>" > Pending for Forwarding </a>
								</h3>
								<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
									<a href = "stat.php?id=<?php echo $code; ?>" > Status of Dak </a>
									</h3>
									<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
										<a href = "listgen.php?id=<?php echo $code; ?>" > List of Generated Daks </a>
										</h3>

									</body>
								</html>