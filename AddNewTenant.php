<?php
session_start();
require 'db.php';

if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];

if($_SERVER['REQUEST_METHOD']==='POST')
{
	$fname = ($_POST['fname']);
	$email = ($_POST['email']);
	$pa = ($_POST['pa']);
	$id = ($_POST['idnum']);
	$phone = ($_POST['phone']);
	$cert = ($_POST['cert']);
	$pin = ($_POST['pin']);
	$sql = "INSERT INTO tenant(Fname,PostAdd,Pin,Id,Cert,Mobile,Email) VALUES('$fname','$pa','$pin','$id','$cert','$phone','$email')";
	if($conn->query($sql) === true)
	{
		echo '<script>alert("The Tenant has been added.")</script>';
		echo '<script>window.location="Dashboard.php"</script>';
	}
	else
	{
		echo '<script>alert("Error Ocurred. Please Try Again.")</script>';
		echo '<script>window.location="Dashboard.php"</script>';
	} 
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Apricot Property Solutions Portal</title>
	<style type="text/css">
		.textinput {
            width: 100%;
            min-height: 75px;
            outline: none;
            resize: none;
            border: 1px solid grey;
        }
        .lbl{
        	font-size: 12px;
        	color: red;
        }

	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#"><img src="Logo101.jpg" height="40"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="Dashboard.php">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="Login.php">Login</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="logout.php">Logout</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	<div style="padding-top: 3%; padding-bottom: 2%; padding-right: 5%; padding-left: 5%">
		<div class="row">
		<div class="col-md-2" style="background-color: #FFFFFF">
			<ul style="padding-top: 1%; padding-bottom: 1%; padding-right: 0%; padding-left: 0%;list-style-type: none;">
      			<li style="padding-top: 2%; padding-bottom: 2%;"><h5 style="text-align: justify;">Actions</h5></li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      			</li>
      		</ul>
		</div>
		<div class="col-md-10" style="padding-right: 2%; padding-left: 5%;">
	<div style="padding-top: 5%; padding-bottom: 2%; padding-right: 10%; padding-left: 40%">
		<h1>New Tenant</h1>
	</div>
		<div class="container">
		<div class="row">
		    <div class="col-md-6">
		      <form action="AddNewTenant.php" method="POST" enctype="multipart/form-data">
		     	<div class="form-group">
			  	<label for="formGroupExampleInput2">Full Name</label>
			  	<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Full Name" required="" name="fname">
				</div>
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Email</label>
				    <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="Email address" name="email" required="">
				</div>
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Postal Address</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Postal address" name="pa" required="">
				</div>
		    </div>	
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Phone Number</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Phone Number" name="phone" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">ID No.</label>
				    <input type="any" class="form-control" id="formGroupExampleInput2" placeholder="ID Number" name="idnum">
				</div>
		    </div>	
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Certificate of Incorp No.</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Certificate of Incorp No." name="cert">
				    <p class="lbl">Only for Commercial Use</p>
				</div>
		    </div>    
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">PIN No.</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="PIN NO." name="pin">
				</div>
		    </div>
		    <div class="col-md-4">
				<div class="form-group" style="padding-top: 1%; padding-bottom: 2%; padding-right: 60%; padding-left: 2%">
		    		<label for="formGroupExampleInput2"></label>
		    		<input type="submit" class="btn btn-dark btn-block" value="Submit">
				</div>
			</div>
		</form>
	</div>
	</body>
	</html>