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
				<h1 style= "font-family : 'book antique'; font-size : 25px; align : center; margin-top : 25px;"> Search By Specific Words </h1>
				<center>
					<form action="" method="post" style = "margin-top : 3%">
						<label > From : </label>
						<input type="date" name="Date1" style= "text-align : center; margin-right:5px ; ">
							<label style= "margin-left:5px"> To : </label>
							<input type="date" name="Date2" style= "text-align : center;">
								<br />
								<br />
								<label style= "margin-left:5px"> Specific Word : </label>
								<input type="text" name="wrd" style= "text-align : center;">
									<br />
									<br />

									<input type="submit" name="srch" style = "margin-top : 10px"> 
									</form>
								</center>
								<center>
									<?php

include('session.php');
ini_set('display_errors',0);
$db = db_open();
$code=$_GET['user'];
$result = mysql_query( "SELECT * FROM emp WHERE code = '$code'" , $db );
$row = mysql_fetch_assoc($result);
$depart  = $row['department'];
$desig = $row['designation'];
$sect = $row['section'];

if($_POST['srch'])
{
	$date1=$_POST['Date1'];
	$date2=$_POST['Date2'];
	$wrd=$_POST['wrd'];
	$datet=date('Y-m-d');
	if($date1 > $date2)
	echo '<script>',"alert('Invalid Period!');",'</script>';
	if( $date1 > $datet && $date2 > $datet )
	echo '<script>',"alert('Invalid Date!');",'</script>';
	if($date1 <= $date2 && $date1 <= $datet && $date2 <= $datet ) {
		echo "<h2 style='margin-top: 50px;'>From ".$date1."  To ".$date2."</h2>";
		$fetch = mysql_query("Select * from track where Generated_by = '$code' and Date_of_Generation between '$date1' and '$date2' order by Date_of_Generation desc",$db);
		$row1 = mysql_fetch_assoc($fetch);
		$fetch5 = mysql_query("Select * from track where Doc_id = '".$row1['Doc_id']."'",$db);
		$row5 = mysql_fetch_assoc($fetch5);
		$stage = $row5['Stage'];
		if($row1)
		{
			$des=$row1['Description'];
			if(stripos($des,$wrd) !== false)
			{
				echo "<div>";
				$arr = array("Document Number" , "Document ID" , "Description" , "Number of Pages" , "Type" , "File Number" , "Date of Generation" , "Stage" , "Action Taken" ,  "Check Status");
				echo "<table rules='ALL' border = 1 style ='margin-top : 40px;'>";
				foreach($arr as $item)
				echo "<th style='min-width:70px'>".$item."</th>";
				while($row1)
				{
					echo "<tr>";
					foreach($row1 as $key=>$row)
					{
						if($row == null)
						$row="-----";
						if(($key!="Department")&&($key!="Section")&&($key!="Generated_by"))
						echo "<td align='center'>".$row."</td>";
						
					}
					echo "<td>
					<h3 style = 'text-align : center; font-size : 15px'>
					<a href = 'track.php?id=".$code."&&doc_id=".$row1['Doc_id']."'> View </a>
					</h3>";
					$row1 = mysql_fetch_assoc($fetch);
					
				}
				
				echo "</table>";
				echo "</div>";
				
			}
			else
			echo "<h1 style='margin-top: 50px;'>No Daks</h1>";
			
		}
	}
}
else{
	$date = Date("Y-m-d");
	$date_ago = date('Y-m-d', strtotime('-7 days'));
	echo "<h2 style='margin-top: 50px;'>From ".$date_ago."  To ".$date."</h2>";
	$fetch = mysql_query("Select * from track where Generated_by = '$code' and Date_of_Generation between '$date_ago' and '$date' order by Date_of_Generation desc",$db);
	$row1 = mysql_fetch_assoc($fetch);
	if($row1)
	{
		echo "<div>";
		$arr = array("Document Number" , "Document ID" , "Description" , "Pages" , "Type" , "File Number" , "Date of Generation" , "Stage" , "Action Taken" ,  "Check Status");
		echo "<table rules='ALL' border = 1 style ='margin-top : 40px;' >";
		$fetch5 = mysql_query("Select * from track where Doc_id = '".$row1['Doc_id']."'",$db);
		$row5 = mysql_fetch_assoc($fetch5);
		$stage = $row5['Stage'];
		foreach($arr as $item)
		echo "<th style='min-width:70px'>".$item."</th>";
		while($row1)
		{
			echo "<tr>";
			foreach($row1 as $key=>$row)
			{
				if($row == null)
				$row="-----";
				if(($key!="Department")&&($key!="Section")&&($key!="Generated_by"))
				echo "<td align='center'>".$row."</td>";
				
			}
			echo "<td>
<h3 style = 'text-align : center; font-size : 15px'>
<a href = 'track.php?id=".$code."&&doc_id=".$row1['Doc_id']."'> View </a>
</h3>";
			$row1 = mysql_fetch_assoc($fetch);
		}
		
		echo "</table>";
		echo "</div>";
	}
	else
	echo "<h1 style='margin-top: 50px;'>No Daks</h1>";
	

}
?>
									<h3 style= "font-family : 'book antique'; font-size : 21px; align : center; margin-top : 30px;">
										<a href = "home.php?user=<?php echo $code; ?>">Back</a>
										</h3>
									</center>
								</body>
							</html>
							