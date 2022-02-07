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

	$pid = ($_POST['property']);
	$tid = ($_POST['tenant']);
	$sdate = ($_POST['sdate']);
	$edate = ($_POST['edate']);
	$rdate = ($_POST['rdate']);
	$idate = ($_POST['idate']);
	$term = ($_POST['term']);
	$iperc = ($_POST['iperc']);
	$isdate = ($_POST['isdate']);
	$iterm = ($_POST['iterm']);
	$dep = ($_POST['dep']);
	$depb = ($_POST['depb']);
	$depd = ($_POST['depd']);
	$signed = isset($_POST['signed']) ? 1 : 0;
	$rent = ($_POST['rent']);
	$unit = ($_POST['unit']);
	
	
	$sql1 = "SELECT `Lease_Id` from `lease` WHERE  PropertyId = $pid AND Unit = $unit AND Lstatus = 'Ongoing'";
	

	
	$sql = "INSERT INTO lease(PropertyId,TenantId,StartDate,EndDate,RenewalDate,Term,IncDate,IncPerc,IncTerm,IncSdate, Deposit,DepositDate,DepositBalance,Rent,Unit,fileloc,signed) VALUES($pid,$tid,'$sdate','$edate','$rdate','$term','$idate','$iperc','$iterm','$isdate',$dep,'$depd',$depb,$rent,'$unit','$filetarget',$signed)";
	
	$result = $conn->query($sql1);
	
	if($result->num_rows === 0) {
	    
	    
	    if($conn->query($sql) === true)
	    {
	        //echo $sql;
		    echo '<script>alert("Lease has been added.")</script>';
	    	echo '<script>window.location="Dashboard.php"</script>';
	    }
	    else
	    {
	        echo $sql;
		    echo '<script>alert("Error Ocurred. Please Try Again.")</script>';
		    //echo '<script>window.location="Dashboard.php"</script>';
		 }
	}
	else{
	    echo '<script>alert("This Unit has already been created.")</script>';
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
		<h1>New Lease</h1>
	</div>
		<div class="container">
		<div class="row">
		    <div class="col-md-6">
		      <form action="AddNewLease.php" method="POST" enctype="multipart/form-data">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Tenant</label>
				  	<select id="customers" name="tenant" style="padding: 6px 12px 6px 12px; width: 100%; border: 1px solid #ced4da;border-radius: 0.25rem;">
				    <?php
				    $display = "SELECT * from tenant ORDER BY Fname;";
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
				     <option value="<?php echo $row['Tenant_Id']; ?>"><?php echo $row['Fname']; ?> </option>
				        <?php
				                  }
				                } 
				        ?>
				  	</select>
				</div>    
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Property</label>
				  	<select id="customers" name="property" style="padding: 6px 12px 6px 12px; width: 100%; border: 1px solid #ced4da;border-radius: 0.25rem;">
				    <?php
				    $display = "SELECT * from property order by Name;";
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
				    <option value="<?php echo $row['Property_Id']; ?>"><?php echo $row['Name']; ?> </option>
				        <?php
				                  }
				                } 
				        ?>
				  	</select>
				</div>  
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Unit</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Unit" name="unit" required="">
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
				    <input type="text" class="form-control" id="edate" placeholder="Lease End Date" name="edate" required="" readonly="">
				</div>
		    </div>	
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Lease Renewal Date</label>
				    <input type="text" class="form-control" id="rdate" placeholder="Lease Renewal Date" name="rdate" required="" readonly="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Lease Increment Start Date</label>
				    <input type="date" class="form-control" id="isdate" placeholder="Lease Increment Start Date" name="isdate" required="" >
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2"> Increment Period</label>
				    <input type="text" class="form-control" id="iterm" placeholder="Increment Period in Months" name="iterm" required="" onchange="myFunc()" >
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Next Increment Date</label>
				    <input type="date" class="form-control" id="idate" placeholder="Lease Increment Start Date" name="idate" required="" >
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Increment Percentage [%]</label>
				    <input type="any" class="form-control" id="formGroupExampleInput2" placeholder="Increment Percentage" name="iperc" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Deposit in Kshs.</label>
				    <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Deposit" name="dep" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Deposit Balance</label>
				    <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Deposit Balance" name="depb">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Deposit Balance Date</label>
				    <input type="date" class="form-control" id="DepositD" placeholder="Lease Increment Date" name="depd" >
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Rent in Kshs.</label>
				    <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Rent" name="rent" required="">
				</div>
		    </div>
		    <div class="col-md-12">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Lease Copy in PDF Format</label>
				    <br>
				    <input type="file" name="leasefile">
				    <br>
					<p style="<?=$style?>"><?=$messages?></p>
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
		   		    <input type="CHECKBOX" name="signed" />
				    <label for="formGroupExampleInput2">Lease Signed</label>
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
			document.getElementById('rdate').value = e[0];
		}
		
		function myFunc() {
			var term = document.getElementById('iterm').value;
			terms = parseInt(term);
			console.log(term);
			var startdate = document.getElementById('isdate').value;
			console.log(startdate);
			var start = startdate.split("-");
			var d = new Date(start[0],start[1],start[2]);
			console.log(d.setMonth(d.getMonth()+terms-1));
			console.log(d);
			var n = d.toISOString();
			console.log(n);
			var e = n.split('T');

			document.getElementById('idate').value = e[0];
		}
	</script>	
	</body>
	</html>