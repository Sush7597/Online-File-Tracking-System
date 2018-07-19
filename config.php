<?php
ini_set( "display_errors", 0); 
function db_open() 
{
	// connecting with Database
	$conn = mysql_connect("localhost","root","");
	if(!$conn) 
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("one",$conn);
	return $conn;
}
function db_close($conn)
{
	mysql_close($conn);
}
?>