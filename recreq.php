<!DOCTYPE html>
<html>
	<head>
		<title> CEL </title>
	</head>
	<style>
img 
{	
	width : 65px;
	height : 55px;
	border : 2px;
	margin-left : 15px;
	margin-top : 15px;
position: absolute; top: 0; left: 0;
}

body	
{
	text-align : center;
	margin-left : 2%;
	margin-right : 2%;
	min-width : 96%;
	margin-top : 5%;
	font-family : 'book antique';
}
label 
{
	font-weight : bold;
	width : 100px;
	font-size : 18px;
	font-family : 'book antique';
}
	</style>

	<body>
		<img src = "imgs/logo.png">
			<h3 style= "font-family : 'Arial'; font-size : 38px; align : center;margin-top : -20px"> Central Electronics Limited </h3>
			<h2 style = "position: absolute; top: 0; right: 0; font-size : 20px; margin-right: 15px; margin-top : 20px;">
				<a href = "logout.php" >Sign Out</a>
			</h2>
			<h1 style= "font-family : 'book antique'; font-size : 25px; align : center; margin-top : -15px;"> ONLINE FILE TRACKING SYSTEM </h1>
			<h1 style= "font-family : 'book antique'; font-size : 25px; align : center; margin-top : 25px;"> Pending Requests </h1>

			<center>
				<?php
include('session.php');
ini_set('display_errors',0);
$db = db_open();
$code=$_GET['id'];
$result = mysql_query( "SELECT * FROM emp WHERE code = '$code'" , $db );
$row = mysql_fetch_assoc($result);
$depart  = $row['department'];
$desig = $row['designation'];
$sect = $row['section'];
$fetch = mysql_query("Select * from track2 where Dispatched_To = '$code' and Status = 'In-Transit'",$db);
$row1 = mysql_fetch_assoc($fetch);
if($row1)
{
	echo "<div>";
	$arr = array("Document Number" , "Document ID");
	echo "<table rules='ALL' border = 1 style ='margin-top : 40px;'>";
	foreach($arr as $item)
	echo "<th style='min-width:200px;'>".$item."</th>";
	echo "<th>"."Open"."</th>";
	while($row1)
	{
		echo "<tr>";
		foreach($row1 as $key=>$row)
		{
			if($key=="Doc_No" || $key=="Doc_id")
			echo "<td align='center' style='min-width:100px;'>". $row ."</td>";
			$doc_id = $row1["Doc_id"];
		}
		echo "<td style='min-width:100px; text-align : center'>";
		echo "<h3 style= 'font-family : 'book antique';'>
<a href = 'req.php?id=".$code."&doc-id=".$doc_id."'> Click </a>
</h3>";
		$row1 = mysql_fetch_assoc($fetch);
	}
	echo "</table>";
	echo "</div>";
}
else 
echo "<h1 style='margin-top: 50px;'>No Daks</h1>";
?>
				<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 30px;">
					<a href = "home.php?user=<?php echo $code; ?>">Back</a>
					</h3>
				</center>
			</body>
		</html>