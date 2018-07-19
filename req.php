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
	<script type="text/javascript">

	</script>
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
$doc_id=$_GET['doc-id'];
$code = $_GET['id'];
$result = mysql_query( "SELECT * FROM emp WHERE code = '$code'" , $db );
$row = mysql_fetch_assoc($result);
mysql_query("SELECT * FROM track ORDER BY Date DESC",$db);
$fetch = mysql_query("Select * from track2 where Doc_id = '$doc_id' ORDER BY S_no DESC LIMIT 1",$db);
$row1 = mysql_fetch_assoc($fetch);
$i = 0;
$rid;
echo	"<h2>"."Details of Dak :"."</h2>";
$arr = array("Doc_No" , "Doc_id" , "Number of Pages" , "Dispatched_By" , "Person_concerned" , "Dispatched_To" , "Date" , "Status", "Type_of_dispatch" , "Remarks");
echo "<table rules='ALL' border = 1  >";

foreach($row1 as $key=>$row)
{	if($row == null)
	$row="-----";
	if($key!="S_no")
	{
		echo "<tr>"."<th align='left'>".$arr[$i]."</th>";
		echo "<td align='left'>". $row ."</td>";
		echo "</tr>";
		echo "</td>";
		$i++;
	}
}
echo "</table>";
$rid=$row1['Dispatched_By'];

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$Stat= $_POST['Stat'];
	$acc="Accepted";
	if($Stat == "Accept")
	{
		mysql_query("Update track2 set Status='$acc' where Doc_id = '$doc_id'  ORDER BY S_no DESC LIMIT 1",$db);
		header("location: recreq.php?id=$code");
	}
	else
	{
		header("location: reject.php?id=$code&&doc-id=$doc_id");
	}
}
?>
				<form action = "" method = "post" style="margin-top:2%;">
					<input list='Stat' name='Stat'>
						<datalist id='Stat'>
							<option value='Accept'>Accept</option>
							<option value='Reject'>Reject</option>
						</datalist>
						<br />
						<br />
						<input type = "Submit" value = "Submit"/>
					</form>
					<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
						<a href = "req.php?id=<?php echo $code; ?>&&doc-id=<?php echo $doc_id ?>">Back</a>
						</h3>
					</center>
				</body>
			</html>