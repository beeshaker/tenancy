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
				<h1>Lease Renewal</h1>
			</div>
		<table class="table">
		  	<thead class="thead-dark">
		    	<tr>
		      		<th>#</th>
		      		<th>Property Name</th>
		      		<th>Tenant Name</th>
		      		<th>Renew</th>
		      		<th>Close</th>
		    	</tr>
		  	</thead>
		  	<?php
				$sql = "SELECT lease.Lease_Id,property.Name,tenant.Fname From property
				inner join lease on property.Property_Id = lease.PropertyId
				inner join tenant on lease.TenantId = tenant.Tenant_Id
				where TIMESTAMPDIFF(day,CURDATE(),EndDate) = 0 and Lstatus = 'Ongoing'";
				$result = $conn->query($sql);
				if($result->num_rows == 0)
				{
					echo '<script>alert("There are no leases due for renewal ")</script>';
					echo '<script>window.location="Dashboard.php"</script>';
			    }
			    else
			    {

			    	while($row = $result->fetch_assoc()) {

		   ?>
		  <tbody>
		    <tr>
		      <th scope="row"><?php echo $row['Lease_Id']; ?></th>
		      <td><?php echo $row['Name']; ?></td>
		      <td><?php echo $row['Fname']; ?></td>
		      <td><button type="button" name = "view"class="btn btn-dark"><a href="UpdateLease.php?action=view&l_id=<?php echo $row['Lease_Id']?>" style="color:white;">Renew</a></button></td>
		      <td><button type="button" name = "view"class="btn btn-dark"><a href="Close.php?l_id=<?php echo $row['Lease_Id']?>" style="color:white;" onclick="return confirm('Do you wish to close the lease?')">Close</a></button></td>
		    </tr>
		    		<?php

		    			}
						}
					
					?>
		  </tbody>
		</table>
	</div>
</div>
</body>
</html>			
