<!DOCTYPE html>
<?php
include('session.php');
ini_set('display_errors',0);
$db = db_open();
$code=$_GET['id'];
$result = mysql_query( "SELECT * FROM emp WHERE code = '$code'",$db);
$row = mysql_fetch_assoc($result);
$depart = $row['department'];
$desig = $row['designation'];
$sect = $row['section'];
$gdate = date('Y-m-d');
$doc_id = "";
$error = "";   
$row4 = "";
$a=0;
$y=1;
$all=mysql_query("SELECT * FROM track ORDER BY Doc_id DESC",$db);
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	$des = $_POST['des'];
	$fno = $_POST['fno'];
	$pcon = $_POST['pcon'];
	$pgs = $_POST['pgs'];
	$doctype = $_POST['type'];
	$dep = $_POST['dep'];
	$ref = $_POST['ref'];
	$status = "In-Transit";
	$fetch1 = mysql_query("Select * from emp Where Person_concerned = '$pcon'",$db);
	$row1 = mysql_fetch_assoc($fetch1);
	$dto = $row1['code'];
	$defid = -1;
	if($dep == $depart)
	$type = "Internal";
	else
	$type = "External";		
	$n="NULL";
	if( $fno == "" )
	{
		mysql_query("INSERT into track (`Doc_No` ,`Description`, `Pages` , `Generated_by` , `Type` , `Department`, `Section`, `Date_of_Generation` , `Stage` , `Action_taken`) VALUES ( '$n' , '$des' , '$pgs' , '$code' , '$doctype' , '$depart' , '$sect' ,'$gdate' , 'Open' , '' ) ",$db);
	}
	else
	mysql_query("INSERT into track (`Doc_No` ,`Description`, `Pages` , `Generated_by` , `Type` , `Department`, `Section`, `File_no` , `Date_of_Generation` , `Stage` , `Action_taken`) VALUES ( '$n' , '$des' , '$pgs' , '$code' , '$doctype' , '$depart' , '$sect' , '$fno' ,'$gdate', 'Open' , '' ) ",$db);
	mysql_query("INSERT into track2 (`Doc_No` , `Doc_id` , `Pages` , `Dispatched_By` , `Person_concerned` , `Dispatched_To` , `Date` , `Status`, `Type_of_dispatch` , `Remarks` ) VALUES ('$n' ,'$defid' , '$pgs' , '$code' , '$pcon' , '$dto' , '$gdate' , '$status' , '$type' , '' ) ",$db);
	$fetch3 = mysql_query("Select * from track Where Doc_No = '$n' AND Generated_by = '$code' ",$db);
	$row3 = mysql_fetch_assoc($fetch3);
	$doc_id = $row3['Doc_id'];
	$Doc_no = "CEL/".$depart."/".$sect."/".date('Y')."/".$fno."/".$doc_id;
	mysql_query("UPDATE track set Doc_No = '$Doc_no' Where Doc_id = '$doc_id' ",$db);
	mysql_query("UPDATE track2 set Doc_id = '$doc_id' , Doc_No = '$Doc_no' Where Dispatched_By= '$code' and  Doc_id = '$defid' ",$db);
	$fetch4 = mysql_query("Select * from track Where Doc_id = '$doc_id' ",$db);
	$fetch5 = mysql_query("Select * from track2 Where Doc_id = '$doc_id' order by S_no desc LIMIT 1",$db);
	$row4 = mysql_fetch_assoc($fetch4);
	$row5 = mysql_fetch_assoc($fetch5);
	if ( $ref != "" )
	{
		mysql_query("Insert into ref (`Ref_no` , `Doc_id`) values ( '$ref' , '$doc_id' )",$db);
		$action = $doctype." with reference number ".$doc_id." has been forwarded to ".$dep;
		mysql_query( " Update track set Stage = 'Sent' , Action_taken = '$action' where Doc_id = '$ref'" ,$db);
		
	}
}
?>
<html>
	<head>
		<title> CEL </title>
	</head>
	<script type="text/javascript">
function hide() {
	var x = document.getElementById("form");
	if (x.style.display !="none") {
		x.style.display = "none";
	}
}

function addSelect(divname) {
	alert("Hello");
}
	</script>

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
	margin-left : 10%;
	margin-right : 10%;
	min-width : 80%;
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
td{
height: 50px;
}
	</style>
	<body>
		<img src = "imgs/logo.png">
			<h3 style= "font-family : 'Arial'; font-size : 38px; align : center;margin-top : -20px"> Central Electronics Limited </h3>
			<h2 style = "position: absolute; top: 0; right: 0; font-size : 20px; margin-right: 15px; margin-top : 20px;">
				<a href = "logout.php" >Sign Out</a>
			</h2>
			<h1 style= "font-family : 'book antique'; font-size : 25px; align : center; margin-top : -15px;"> ONLINE FILE TRACKING SYSTEM </h1>
			<center>
				<div id ="form">
					<form action = "" method = "post">
						<h3 style= "font-family : 'book antique'; font-size : 23px; align : center; margin-top : 30px;"> Generate a new Dak  </h3>
						<table id="table" border : "1" >
							<tr>
								<td style ="min-width:200px;">
									<b> Type </b>
								</td>
								<td>
									<Select name="type" type = "list" style = "width : 160px"  required>
										<option selected disabled value="">Select Type</option>
										<option value="Noting">Noting</option>
										<option value="Letter">Letter</option>
										<option value="File">File</option>
										<option value="Document">Document</option>
										<option value="Office Order">Office Order</option>
										<option value="Confidential">Confidential</option>
										<option value="Other">Other</option>
									</Select>
								</td>
							</tr>
							<tr>
								<td>
									<b>File number</b>
								</td>
								<td>
									<input type="text" name="fno" size="20" >
									</td>
								</tr>
								<tr>
									<td>
										<b>Number of Pages</b>
									</td>
									<td>
										<input type="number" name="pgs" size="20" min="1" step="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
											</td>
										</tr>
										<tr>
											<td>
												<b>Brief Description</b>
											</td>
											<td>
												<input type="text" name="des" size="20" required>
												</td>
											</tr>
											<td>
												<b>Reference Number </b>
											</td>
											<td>
												<input type="number" name="ref" size="20" min="1" step="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
													</td>
												</tr>
												<div id ="form1">
													<tr>
														<td>
															<b> Person Concerned </b>
														</td>
														<td>
															<input list="Person Concerned" name="pcon" size="20" required>
																<datalist id="Person Concerned">
																	<option selected disabled value="">Select Person Concerned</option>
																	<option value="GM">GM</option>
																	<option value="AGM">AGM</option>
																	<option value="ED">ED</option>
																	<option value="TO">TO</option>
																	<option value="HOD">HOD</option>
																	<option value="CM">CM</option>
																	<option value="CMD">CMD</option>
																</datalist>
																<br />
															</td>
														</tr>
														<tr>
															<td>
																<b> Department </b>
															</td>
															<td>
																<Select id="dep" list="dep" name="dep" style = "margin-top : 1px; width : 160px" required>
																	<option selected disabled value="">Select Department</option>
																	<option value="HRD">HRD</option>
																	<option value="MED">MED</option>
																	<option value="SPD">SPD</option>
																</Select>
																<br />
																<input type="button" id="add" style = "margin-top : 4px; float : center; width : 12em" onclick= " addSelect(form1); return false; " value = "Add More" 
																	</td>
																</tr>
															</div>
														</table>
														<p>
															<input type = "submit" value = " Submit ">
															</p>
															<div style = "font-size:11px; color:#cc0000; margin-top:10px">
																<?php echo $error; ?>
															</div>
															<h4 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;">
																<a href = "home.php?user=<?php echo $code ?>" > Cancel </a>
																</h4>
															</form>
														</div>
													</center>
													<form>
														<div>
															<center>
																<?php
if($row4 != NULL)
{
	
	echo '<script>','hide();','</script>';
	$i = 0;
	echo	"<h2>"."Details of Generated Dak are :"."</h2>";
	$arr = array("Document Number" , "Document ID" , "Description" , "Pages" , "Generated By" , "Type of Document" , "Generation Department" , "Section" , "File Number" , "Date of Generation" , "Stage" , "Reference Document ID"  , "Person Concerned" , "Dispatched To" , "Status" , "Type of Dispatch" , "Remarks");
	echo "<table rules='ALL' border = 1>";
	foreach($row4 as $key=>$row)
	{		if($key != "Action_taken")
		{
			if ($row == "")
			$row = "------";
			echo "<tr>
<th align='left' style='min-width:300px;'>".$arr[$i]."</th>";
			echo "<td align='left' style='min-width:300px;'>". $row ."</td>";
			$i++;
		}
	}
	echo "<tr>
<th align='left' style='min-width:300px;'>".$arr[$i]."</th>";
	echo "<td align='left' style='min-width:300px;'>".$ref."</td>";
	$i++;
	foreach($row5 as $key1=>$row1)
	{		if( $key1!= "S_no" && $key1!= "Doc_id" && $key1!= "Doc_No" && $key1!= "Pages" && $key1!= "Dispatched_By" && $key1!= "Date" )
		{
			if ($row1 == "")
			$row1 = "------";
			echo "<tr>
<th align='left' style='min-width:300px;'>".$arr[$i]."</th>";
			echo "<td align='left' style='min-width:300px;'>". $row1 ."</td>";
			$i++;
		}
	}
	echo "</table>";
	echo "<h3 style= 'font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;'>
<a href = home.php?user=".$code.">Confirm</a>
</h3>";
	echo "<h3 style= 'font-family : 'book antique'; font-size : 21px; align : center; margin-top : 20px;'>
<a href = discard.php?user=".$code."&id=".$doc_id."&ref=".$ref.">Discard</a>
</h3>";
}
?>
															</div>
														</form>
													</center>
												</body>
											</html>