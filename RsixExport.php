<?php  

require('db.php');
$sql="SELECT lease.Unit, lease.RenewalDate, lease.IncDate, lease.Lease_Id,property.Name,tenant.Fname, tenant.Email From property inner join lease on property.Property_Id = lease.PropertyId inner join tenant on lease.TenantId = tenant.Tenant_Id where TIMESTAMPDIFF(day,CURDATE(),EndDate) Between 92 and 180 and Lstatus = 'Ongoing'";
$res=mysqli_query($conn,$sql);
$html='<table><tr><td>Unit</td><td>Property Name</td><td>Tenant Name</td><td>RenewalDate</td><td>IncDate</td><td>Email</td> </tr>';
while($row=mysqli_fetch_assoc($res)){
	$html.='<tr><td>'.$row['Unit'].'</td><td>'.$row['Name'].'</td><td>'.$row['Fname'].'</td><td>'.$row['RenewalDate'].'</td><td>'.$row['IncDate'].'</td><td>'.$row['Email'].'</td></tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=report.xls');

echo $html;

?>