<?php 
include('session.php');
ini_set('display_errors',0);
$db = db_open();
$doc_id=$_GET['id'];
$code = $_GET['user'];
$ref = $_GET['ref'];
if ($ref == "")
{
	mysql_query("Delete from track where Doc_id = '$doc_id'",$db);
	mysql_query("Delete from track2 where Doc_id = '$doc_id'",$db);
}
else 
{
	mysql_query("Delete from track where Doc_id = '$doc_id'",$db);
	mysql_query("Delete from track2 where Doc_id = '$doc_id'",$db);
	mysql_query("Delete from ref where Ref_no = '$ref' and Doc_id = '$doc_id'",$db);
	mysql_query( " Update track set Stage = 'Open' Action_taken = '' where Doc_id = '$ref'" ,$db);
}
header("location: home.php?user=$code");
?>