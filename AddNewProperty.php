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
	$pname = ($_POST['pname']);
	$type = ($_POST['type']);
	$adlone = ($_POST['adlone']);
	$adltwo = ($_POST['adltwo']);
	$city = ($_POST['city']);
	$owner = ($_POST['owner']);
	$sql = "INSERT INTO property(Name,Type,AddressOne,AddressTwo,City,Owner_Id) VALUES('$pname','$type','$adlone','$adltwo','$city','$owner')";
	if($conn->query($sql) === true)
	{
		echo '<script>alert("The Property has been added.")</script>';
		echo '<script>window.location="Dashboard.php"</script>';
	}
	else
	{
		echo $sql;
		echo '<script>alert("Error Ocurred. Please Try Again.")</script>';
		//echo '<script>window.location="Dashboard.php"</script>';
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
		<h1>New Property</h1>
	</div>
		<div class="container">
		<div class="row">
		    <div class="col-md-6">
		      <form action="AddNewProperty.php" method="POST" enctype="multipart/form-data">
		     	<div class="form-group">
			  	<label for="formGroupExampleInput2">Property Name</label>
			  	<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Property Name" required="" name="pname">
				</div>
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Type</label>
				    <select class="form-control" id="sel1" name="type">
				   	<option value="Residential">Residential</option>
				    <option value="Commercial">Commercial</option>
				  </select>
				</div>
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Address Line 1</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Address Line 1" name="adlone" required="">
				</div>
		    </div>	
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Address Line 2</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Address Line 2" name="adltwo" required="">
				</div>
		    </div>	
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">City</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="City" name="city">
				</div>
		    </div>	
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Owner</label>
				  	<select id="customers" name="owner" style="padding: 6px 12px 6px 12px; width: 100%; border: 1px solid #ced4da;border-radius: 0.25rem;">
				    <?php
				    $display = "SELECT * from owner;";
				                $result = $conn->query($display);
				                if($result->num_rows == 0)
				                {
				                  echo "nope";
				                }
				                else
				                {
				                  while($row = $result->fetch_assoc()) 
				                  {
				    ?>
				    <option value="<?php echo $row['Owner_Id']; ?>">ID:<?php echo $row['Owner_Id']; ?> | Name: <?php echo $row['Fname']; ?></option>
				        <?php
				                  }
				                } 
				        ?>
				  	</select>
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