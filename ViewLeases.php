<?php
session_start();
require 'db.php';

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
	<style type="text/css">
		.textinput {
            width: 100%;
            min-height: 75px;
            outline: none;
            resize: none;
            border: 1px solid grey;
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
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<a href="Dashboard.php" style="color:white;"><button type="button" class="btn btn-dark btn-block">Back</button></a>
      			</li>
      		</ul>
		</div>
		<div class="col-md-10" style="padding-right: 2%; padding-left: 5%;">
			<div style="padding-top: 5%; padding-bottom: 2%; padding-right: 10%; padding-left: 40%">
				<h1>View Leases</h1>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
						    <form action="ViewLeases.php" method="POST">
							<label for="formGroupExampleInput2">Property</label>
							<select id="customers" name="property" style="padding: 6px 12px 6px 12px; width: 100%; border: 1px solid #ced4da;border-radius: 0.25rem;">
							    <?php
							    $display = "SELECT * from property;";
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
								<option value="<?php echo $row['Property_Id']; ?>">ID:<?php echo $row['Property_Id']; ?> | Name: <?php echo $row['Name']; ?></option>
							        <?php
							                  }
							                } 
							        ?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
		   				<div class="form-group">
		   					<label style="color: white"></label>
				    		<input type="submit" class="btn btn-dark btn-block" value="Search">
						</form>
						</div>
					</div>
				</div>
			</div>
		<table class="table">
		  	<thead class="thead-dark">
		    	<tr>
		      		<th>Unit</th>
		      		<th>Property Name</th>
		      		<th>Tenant Name</th>
		      		<th>View</th>
		    	</tr>
		  	</thead>
		  	<?php 

		  	if($_SERVER['REQUEST_METHOD']==='POST')
			{
				$pid = ($_POST['property']);
				$tid = ($_POST['tenant']);

				$sql = "SELECT * FROM property INNER JOIN lease ON lease.PropertyId = property.Property_Id INNER JOIN tenant on lease.TenantId = tenant.Tenant_Id WHERE PropertyId = $pid ORDER BY lease.Unit ASC; ";
				$result = $conn->query($sql);
				if($result->num_rows == 0)
				{

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
		  <tbody>
		    <tr>
		      <th scope="row"><?php echo $row['Unit']; ?></th>
		      <td><?php echo $row['Name']; ?></td>
		      <td><?php echo $row['Fname']; ?></td>
		      <td><button type="button" name = "view"class="btn btn-dark"><a href="UpdateLease.php?action=view&l_id=<?php echo $row['Lease_Id']?>" style="color:white;">VIEW</a></button></td>
		    </tr>
		    		<?php

		    			}
						}
					}
					?>
		  </tbody>
		</table>
	</div>
</div>
</body>
</html>			
