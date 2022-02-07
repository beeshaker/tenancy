<?php 
session_start();
require 'db.php';
$today = $oneM = $twoM = $threeM = $sixM = 0;
$rtoday = $roneM = $rtwoM = $rthreeM = $rsixM = 0;
$signed = 0; 
if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Apricot Property Solutions Portal</title>
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
	<div style="padding-top: 2%; padding-bottom: 2%; padding-right: 10%; padding-left: 3%;" >
  		<div class="row">
    		<div class="col-md-3" style="background-color: #FFFFFF">
      		<!-- Content -->
      		<ul style="padding-top: 2%; padding-bottom: 2%; padding-right: 0%; padding-left: 0%;list-style-type: none;">
      			<li style="padding-top: 2%; padding-bottom: 2%;"><h5 style="text-align: justify;">Actions</h5></li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AddNewOwner.php" style="color:white;">Add New Owner</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AddNewTenant.php" style="color:white;">Add New Tenant</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AddNewProperty.php" style="color:white;">Add New Property</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AddNewLease.php" style="color:white;">Add New Lease</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="ViewLeases.php" style="color:white;">View Lease</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="ViewVacants.php" style="color:white;">View Vacants</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AddNewEmployee.php" style="color:white;">Add New User</a></button>
      			</li>
      			
			</ul>
		    </div>
    		<div class="col-md-9" style="padding-right: 2%; padding-left: 5%;">
      		<!-- Content -->
      			<div style="padding-top: 3%; padding-bottom: 2%; text-align: center;">
					<h1>DashBoard</h1>
				</div>
				<div style="padding-top: 3%; padding-bottom: 2%;text-align: center;padding-right: 2%; padding-left: 2%;">
				</div>
				<?php
					$sql = "SELECT User_Id FROM users WHERE Email ='$Username'";
					$result = $conn->query($sql);
					if($result->num_rows == 0)
					{
						echo '<script>alert("The user does not exist. Please login. ")</script>';
						echo '<script>window.location="Login.php"</script>';
				    }
				    else
				    {
				    	while($row = $result->fetch_assoc()) 
				    	{
				    	 $user = $row['User_Id'];
				    	// echo $cid;
				    	// echo $pid;
				    	}
					}
				$Username = $_COOKIE["user"];
				//$today = $oneM = $threeM = $sixM = "";
				$todaysDate = new DateTime();
				$sql = "SELECT TIMESTAMPDIFF(day,CURDATE(),EndDate) AS Months FROM lease where Lstatus = 'ongoing';";
				$result = $conn->query($sql);
				if($result->num_rows == 0)
				{

			    }
			    else
			    {
			    	while($row = $result->fetch_assoc()) 
			    	{
			    		
			    		 //echo ($row['EndDate']);
			    		 foreach ($row as $x => $value) {
			    		 	
  							if($value == 0)
  							{
  								$today = $today + 1;
  							}
  							else if(($value >= 1)&&($value <= 31))
  							{
  								$oneM = $oneM + 1;
  							}
  							else if(($value >= 32)&&($value <= 61))
  							{
  								$twoM = $twoM + 1;
  							}
  							else if(($value >= 62)&&($value <= 91))
  							{
  								$threeM = $threeM + 1;
  							}
  							else if(($value >= 92)&&($value <= 180))
  							{
  								$sixM = $sixM + 1;
  							}
  							else{
  							   

  							}

			    		 }
			    	}

				?>
				<h3 style="text-align: center;;">Lease Due For Renewal</h3>
				<br>
	      		<div class="card-group">
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">Today</h4></center>
					      <h1 style="text-align: center;"><a href="RToday.php" style="color:black;"><strong><?php echo $today; ?></strong></a></h1>
					    </div>
					</div>
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">1 Month</h4></center>
					      <h1 style="text-align: center;"><a href="ROne.php" style="color:black;"><strong><?php echo $oneM; ?></strong></a></h1>
					    </div>
					</div>
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">2 Months</h4></center>
					      <h1 style="text-align: center;"><a href="RTwo.php" style="color:black;"><strong><?php echo $twoM; ?></strong></a></h1>
					    </div>
					</div>
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">3 Months</h4></center>
					      <h1 style="text-align: center;"><a href="RThree.php" style="color:black;"><strong><?php echo $threeM; ?></strong></a></h1>
					    </div>
					</div>
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">6 Months</h4></center>
					      <h1 style="text-align: center;"><a href="RSix.php" style="color:black;"><strong><?php echo $sixM; ?></strong></a></h1>
					    </div>
					</div>
					</div>
				<?php } ?>
				<br>
				<br>
				
				<?php
					
				$sql = "SELECT TIMESTAMPDIFF(day,CURDATE(),IncDate) AS Months FROM lease where Lstatus = 'ongoing';";
				$result = $conn->query($sql);
				if($result->num_rows == 0)
				{

			    }
			    else
			    {
			    	while($row = $result->fetch_assoc()) 
			    	{
			    		
			    		 //echo ($row['EndDate']);
			    		 foreach ($row as $x => $value) {
			    		 	
  							if($value == 0)
  							{
  								$rtoday = $rtoday + 1;
  							}
  							else if(($value >= 1)&&($value <= 31))
  							{
  								$roneM = $roneM + 1;
  							}
  							else if(($value >= 32)&&($value <= 61))
  							{
  								$rtwoM = $rtwoM + 1;
  							}
  							else if(($value >= 62)&&($value <= 91))
  							{
  								$rthreeM = $rthreeM + 1;
  							}
  							else if(($value >= 92)&&($value <= 180))
  							{
  								$rsixM = $rsixM + 1;
  							}
  							else{
  							   

  							}

			    		 }
			    	}

				?>
				<br>
				<h3 style="text-align: center;;">Lease Due For Increment</h3>
				<br>
	      		<div class="card-group">
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">Today</h4></center>
					      <h1 style="text-align: center;"><a href="LToday.php" style="color:black;"><strong><?php echo $rtoday; ?></strong></a></h1>
					    </div>
					</div>
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">1 Month</h4></center>
					      <h1 style="text-align: center;"><a href="LOne.php" style="color:black;"><strong><?php echo $roneM; ?></strong></a></h1>
					    </div>
					</div>
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">2 Months</h4></center>
					      <h1 style="text-align: center;"><a href="LTwo.php" style="color:black;"><strong><?php echo $rtwoM; ?></strong></a></h1>
					    </div>
					</div>
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">3 Months</h4></center>
					      <h1 style="text-align: center;"><a href="LThree.php" style="color:black;"><strong><?php echo $rthreeM; ?></strong></a></h1>
					    </div>
					</div>
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">6 Months</h4></center>
					      <h1 style="text-align: center;"><a href="LSix.php" style="color:black;"><strong><?php echo $rsixM; ?></strong></a></h1>
					    </div>
					</div>
					</div>
				<?php } ?>
				
				<br>
				
				
				<?php
					
				$sql = "SELECT COUNT(signed) AS num_signed FROM lease where signed = 0 ";
				$result = $conn->query($sql);
				if($result->num_rows == 0)
				{

			    }
			    else
			    {
			       while($row = $result->fetch_assoc()) 
				    	{
				    	 $signed = $row['num_signed'];
				    
				    	}

				?>
				<br>
				<h3 style="text-align: center;;">Unsigned Leases</h3>
				<div class="card-group">
					<div class="card">
					    <div class="card-body">
					      
					      <h1 style="text-align: center;"><a href="Lunsigned.php" style="color:black;"><strong><?php echo $signed; ?></strong></a></h1>
					    </div>
					</div>
					
					</div>
					
					<br>
				<h3 style="text-align: center;;">Vacant Units</h3>
				<div class="card-group">
					<div class="card">
					    <div class="card-body">
					      
					      <h1 style="text-align: center;"><a href="Lunsigned.php" style="color:black;"><strong><?php echo $signed; ?></strong></a></h1>
					    </div>
					</div>
					
					</div>
					<?php } ?>
				
				
				
				</div>
    		</div>
		</div>
	</div>
</body>
</html>