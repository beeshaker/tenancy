<?php
session_start();
require 'db.php';
$style='none';
$messages = '';
if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];
$id = $_GET["l_id"];
	$sql = "UPDATE lease set Lstatus='Closed' where Lease_Id = $id";
	if($conn->query($sql) === true)
	{
		//echo $sql;
		echo '<script>alert("The Lease has been Closed.")</script>';
		echo '<script>window.location="Dashboard.php"</script>';
	}
	else
	{
		echo $sql;
		echo '<script>alert("Error Ocurred. Please Try Again.")</script>';
		//echo '<script>window.location="Dashboard.php"</script>';
	} 
