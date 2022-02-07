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


if($_SERVER['REQUEST_METHOD']==='POST')
{
	//-------------------
	$fileexistsflag = 0;
	$filename = $_FILES["leasefile"]['name'];

	$target = "LeaseFileCopy/";
	$filetarget = $target.$filename;
	$tempfilename = $_FILES["leasefile"]["tmp_name"];
	$size = $_FILES["leasefile"]['size'];
	$result = move_uploaded_file($tempfilename, $filetarget);

		if($result)
		{
			$style='block';
			$messages = 'File has been uploaded.';
		}
		else
		{
			$style='block';
			$messages = 'File has been not been uploaded.';
		}

	//-------------------

	$id = ($_POST['id']);
	$sdate = ($_POST['sdate']);
	$edate = ($_POST['edate']);
	$rdate = ($_POST['rdate']);
	$idate = ($_POST['idate']);
	$term = ($_POST['term']);
	$rent = ($_POST['rent']);
	$sql = "UPDATE Lease set StartDate='$sdate',EndDate = '$edate',RenewalDate = '$rdate', IncDate='$idate', Term=$term,Rent=$rent,fileloc = '$filetarget' where Lease_Id = $id;";
	if($conn->query($sql) === true)
	{
		//echo $sql;
		echo '<script>alert("The Lease has been renewed.")</script>';
		echo '<script>window.location="Dashboard.php"</script>';
	}
	else
	{
		echo $sql;
		echo '<script>alert("Error Ocurred. Please Try Again.")</script>';
		//echo '<script>window.location="Dashboard.php"</script>';
	} 
}