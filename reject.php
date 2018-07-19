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
$rej="Rejected";
$result = mysql_query( "SELECT * FROM emp WHERE code = '$code'" , $db );
$row = mysql_fetch_assoc($result);
mysql_query("SELECT * FROM track ORDER BY Date DESC",$db);
$fetch = mysql_query("Select * from track2 where Doc_id = '$doc_id' ORDER BY S_no DESC LIMIT 1",$db);
$row1 = mysql_fetch_assoc($fetch);
$rid=$row1['Dispatched_By'];
$ft = mysql_query("Select * from emp where code = '$rid'",$db);
$r = mysql_fetch_assoc($ft);
$per =  $r['Person_concerned'];
$dat = Date('Y-m-d');
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$remarks = $_POST['Remarks'];
	mysql_query("Update track2 set Status = '$rej' , Remarks = '$remarks' where Doc_id = '$doc_id' LIMIT 1",$db);
	$s = "Insert into track2 (`Doc_No` , `Doc_id` , `Pages` , `Dispatched_By` , `Person_concerned` , `Dispatched_To` , `Date` , `Status` , `Type_of_dispatch` , `Remarks`) values ('".$row1['Doc_No']."','".$row1['Doc_id']."','".$row1['Pages']."','".$code."','".$per."','".$rid."','".$dat."','In-Transit','".$row1['Type_of_dispatch']."','')";
	mysql_query($s,$db);
	header("location: recreq.php?id=$code");
}
?>
				<form action = "" method = "post" style="margin-top:4%;">
					<div id = "form" >
						<label style="margin-top:2%;"> Reason to Reject   : </label>
						<br />
						<input type = "text" name = "Remarks" class = "box" style="margin-top:2%;"  required>
							<br />
							<br />
						</div>
						<input type = "Submit" value = "Submit" style="margin-top:3%;"/>
					</form>
					<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
						<a href = "recreq.php?id=<?php echo $code; ?>">Back</a>
						</h3>
					</center>
				</body>
			</html>