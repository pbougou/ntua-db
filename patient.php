<?php 
	header('Content-type: text/html; charset:utf8');
	include('inc/header.inc.php');
	include('inc/connect.inc.php');
?>

<div id="menu">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="pharmacy.php">Pharmacies</a></li>
		<li><a href="medicine.php">Medicines</a></li>
		<li><a href="company.php">P. Companies</a></li>
		<li><a href="doctor.php">Doctors</a></li>
		<li><a href="patient.php" style="background-color:#5bd75b">Patients</a></li>
	</ul>
</div>

<div id="main">

<div id="menu2">
	<ul>
		<li><a href="patient.php" style="background-color:#5bd75b">Summary</a></li>
		<li><a href="patientDrugs.php">Drug Prescriptions</a></li>
	</ul>
</div>
<br/><br/>

<?php
	$sql1="SELECT * FROM patientView";
	$mydata1 = mysql_query($sql1,$con);
	echo "
	<p><b>Public non-updatable View :</b></p>
	<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Age</th>
	</tr>";
	while ($record1 = mysql_fetch_array($mydata1)){
		echo "
		<tr>
		<td>$record1[FirstName]</td>
		<td>$record1[LastName]</td>
		<td>$record1[Age]</td>
		</tr>";
	}
	echo "</table>";

	$sql2="SELECT * FROM Patient";
	$mydata2 = mysql_query($sql2,$con);
	echo "
	<p><b>Private Database Table :</b></p>
	<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>ID</th>
		<th>Name</th>
		<th>Town</th>
		<th>Address</th>
		<th>Age</th>
		<th>Attending Doctor</th>
	</tr>";
	while ($record2 = mysql_fetch_array($mydata2)) {
		$sql3 = "SELECT Doctor.FirstName, Doctor.LastName
				 FROM Doctor WHERE Doctor.DoctorId='$record2[DoctorId]'";
		$mydata3 = mysql_query($sql3,$con);
		$dname = mysql_fetch_array($mydata3);
		echo "
		<tr>
		<td>$record2[PatientId]</td>
		<td>$record2[FirstName] $record2[LastName]</td>
		<td>$record2[Town]</td>
		<td>$record2[StreetName] $record2[StreetNumber], $record2[PostalCode]</td>
		<td>$record2[Age]</td>
		<td>$dname[FirstName] $dname[LastName]</td>
		</tr>";
	}
	echo "</table>";
?>

</div>

<?php
	include('inc/footer.inc.php');
?>