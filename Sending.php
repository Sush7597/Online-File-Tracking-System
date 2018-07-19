<!DOCTYPE html>
<html>
	<head>
		<title> CEL </title>
		<link rel="stylesheet" type="text/css" href="style.css">
		</head>

		<body>
			<img src = "imgs/logo.png">
				<h3 style= "font-family : 'Arial'; font-size : 38px; align : center;margin-top : -20px"> Central Electronics Limited </h3>
				<h2 style = "position: absolute; top: 0; right: 0; font-size : 20px; margin-right: 15px; margin-top : 20px;">
					<a href = "logout.php" >Sign Out</a>
				</h2>
				<h1 style= "font-family : 'book antique'; font-size : 25px; align : center; margin-top : -15px;"> ONLINE FILE TRACKING SYSTEM </h1>
				<h1 style= "font-family : 'book antique'; font-size : 25px; align : center; margin-top : 25px;"> Send Dak </h1>

				<center>
					<?php 
include('session.php');
ini_set('display_errors',0);
$db = db_open();
$doc_id=$_GET['doc-id'];
$code = $_GET['id'];
$result = mysql_query( "SELECT * FROM emp WHERE code = '$code'" , $db );
$row = mysql_fetch_assoc($result);
$depart = $row['department'];
$fetch = mysql_query("Select * from track2 where Doc_id = '$doc_id' order by S_no desc LIMIT 1",$db);
$row1 = mysql_fetch_assoc($fetch);
$doc_no=$row1['Doc_No'];
$sno= $row1['S_no'];

$i = 0;
$rid;
echo	"<h2>"."Details of Dak :"."</h2>";
$arr = array("Doc_No" , "Doc_id" , "Number of Pages" , "Dispatched_By" , "Person_concerned", "Date" , "Status", "Type_of_dispatch" );
echo "<table rules='ALL' border = 1  >";

foreach($row1 as $key=>$row)
{	if($row == null)
	$row="-----";
	if($key!="Dispatched_To"&& $key!="S_no" && $key!="Remarks")
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
$num=0;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$pgs=$_POST['pgs'];
	$pcon=$_POST['pcon'];
	$dep=$_POST['dep'];
	if($dep == $depart)
	$type = "Internal";
	else
	$type = "External";
	$status = "In-Transit";
	$date = date('Y-m-d');
	$fetch1 = mysql_query("Select * from emp Where Person_concerned = '$pcon'",$db);
	$row1 = mysql_fetch_assoc($fetch1);
	$dto = $row1['code'];
	mysql_query("Insert into track2(`Doc_No` , `Doc_id` , `Pages` , `Dispatched_By` , `Person_concerned` , `Dispatched_To` , `Date` , `Status`, `Type_of_dispatch`, `Remarks`) values ('$doc_no','$doc_id','$pgs','$code','$pcon','$dto','$date','$status','$type' , '')",$db);
	mysql_query("UPDATE track2 set Remarks = 'Forwarded' where S_no = '$sno'",$db);
	$num=1;
}
if($num==1)
{
	header("location: send.php?id=$code");
}
?>
					<form action = "" method = "post" style="margin-top:2%;">
						<table id="table" border : "1" >
							<div>
								<tr>
									<td>Number of Pages</td>
									<td>
										<input type="number" name="pgs" size="30" min="1" step="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
											</td>
										</tr>
										<tr>
											<td> Person Concerned </td>
											<td>
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
													<tr>
														<td> Department </td>
														<td>
															<Select id="dep" list="dep" name="dep" style = "margin-top : 1px; width : 160px" required>
																<option selected disabled value="">Select Department</option>
																<option value="HRD">HRD</option>
																<option value="MED">MED</option>
																<option value="SPD">SPD</option>
															</Select>
															<br />
														</td>
													</tr>
												</div>
											</table>
											<input type = "Submit" style = "margin-top : 20px" value = "Send" onclick = "alert('Dak Sent');" />
										</form>
										<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
											<a href = "send.php?id=<?php echo $code; ?>">Back</a>
											</h3>
										</center>
									</body>
								</html>