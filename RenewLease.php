<?php
session_start();
require 'db.php';
$style='none';
$messages = '';
if (!isset($_COOKIE["user"]))
{
	header("location:  index.php");
	exit();
}
$Username = $_COOKIE["user"];


$l_id = $_GET["l_id"];
$sql = "SELECT * FROM property INNER JOIN lease ON lease.PropertyId = property.Property_Id INNER JOIN tenant on lease.TenantId = tenant.Tenant_Id WHERE Lease_Id = $l_id ; ";
	$result = $conn->query($sql);
	if($result->num_rows == 0)
	{
		echo '<script>alert("No complaints")</script>';
		echo '<script>window.location="Login.php"</script>';
    }
    else
    {
    	//echo '<script>alert("There are complaints ")</script>';
		//echo '<script>window.location="login.php"</script>';
    	while($row = $result->fetch_assoc()) {
    	//$incharge = $row['u_id'];
    	// echo $cid;
    	// echo $pid;
    
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
	        <a class="nav-link" href="Login.php">Home <span class="sr-only">(current)</span></a>
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
		<h1>View Lease</h1>
	</div>
		<div class="container">
		<div class="row">
		    <div class="col-md-6">
		      <form action="Renew.php" method="POST" enctype="multipart/form-data">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Tenant</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Lease End Date" name="tenant" required="" readonly="" value="<?php echo $row['Fname']?>">
				</div>    
				<div class="form-group">
				    <input type="hidden" name="id" value="<?php echo $row['Lease_Id']?>">
				</div> 
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Property</label>
				  	<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Lease End Date" name="property" required="" readonly="" value="<?php echo $row['Name']?>">
				</div>  
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Unit</label>
				    <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Unit" name="unit" required=""readonly="" value="<?php echo $row['Unit']?>">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Lease Start Date</label>
				    <input type="date" class="form-control" id="sdate" placeholder="Lease Start Date" name="sdate" required="">
				</div>
		    </div>	
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Lease Term [Months]</label>
				    <input type="text" class="form-control" id="term" placeholder="Lease Term" name="term" required="" onchange="myFunction()">
				</div>
		    </div>	
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Lease End Date</label>
				    <input type="text" class="form-control" id="edate" placeholder="Lease End Date" name="edate"required="" readonly="">
				</div>
		    </div>	
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Lease Renewal Date</label>
				    <input type="text" class="form-control" id="rdate" placeholder="Lease Renewal Date" name="rdate" required="" readonly="" >
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Lease Increment Date</label>
				    <input type="text" class="form-control" id="idate" placeholder="Lease Increment Date" name="idate" required="" readonly="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Increment Percentage [%]</label>
				    <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Increment Percentage" name="iperc" required="" readonly="" value="<?php echo $row['IncPerc']?>">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Deposit in Kshs.</label>
				    <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Deposit" name="dep" required="" readonly="" value="<?php echo $row['Deposit']?>">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Rent in Kshs.</label>
				    <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Rent" name="rent" required="" >
				</div>
		    </div>
		     <div class="col-md-12">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Renewed Lease Copy in PDF Format</label>
				    <br>
				    <input type="file" name="leasefile" required="">
				    <br>
					<p style="<?=$style?>"><?=$messages?></p>
				</div>
		    </div>
		    <div class="col-md-4">
				<div class="form-group" style="padding-top: 1%; padding-bottom: 2%; padding-right: 60%; padding-left: 2%">
		    		<label for="formGroupExampleInput2"></label>
		    		<input type="submit" class="btn btn-dark btn-block" value="Submit">
				</div>
			</div>

		<?php }}?>
		</form>
	</div>

		<script>
		function myFunction() {
			var term = document.getElementById('term').value;
			terms = parseInt(term);
			console.log(term);
			var startdate = document.getElementById('sdate').value;
			console.log(startdate);
			var start = startdate.split("-");
			var d = new Date(start[0],start[1],start[2]);
			console.log(d.setMonth(d.getMonth()+terms-1));
			console.log(d);
			var n = d.toISOString();
			console.log(n);
			var e = n.split('T');

			document.getElementById('edate').value = e[0];
			document.getElementById('idate').value = e[0];
			document.getElementById('rdate').value = e[0];
		}
	</script>	
	</body>
	</html>