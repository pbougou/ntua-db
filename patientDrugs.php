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
		<li><a href="patient.php">Summary</a></li>
		<li><a href="patientDrugs.php" style="background-color:#5bd75b">Drug Prescriptions</a></li>
	</ul>
</div>
<br/><br/>

<?php
	$sql1 = "SELECT Patient.FirstName as pfn, Patient.LastName as pln,
					Doctor.FirstName as dfn, Doctor.LastName as dln, Drug.Name,
					Prescription.PrescriptionDate, Prescription.Quantity
			 FROM ( (Prescription inner join Patient on Prescription.PatientId=Patient.PatientId) 
			 		inner join Doctor on Prescription.DoctorId=Doctor.DoctorId) 
					inner join Drug on Prescription.DrugId=Drug.DrugId";
	$mydata1 = mysql_query($sql1,$con);
	echo "
	<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>Patient</th>
		<th>Doctor</th>
		<th>Drug</th>
		<th>Drug Quantity</th>
		<th>Prescription Date</th>
	</tr>";
	while ($record1 = mysql_fetch_array($mydata1)) {
		echo "
		<tr>
		<td>$record1[pfn] $record1[pln]</td>
		<td>$record1[dfn] $record1[dln]</td>
		<td>$record1[Name]</td>
		<td>$record1[Quantity]</td>
		<td>$record1[PrescriptionDate]</td>
		</tr>";
	}
	echo "</table>";
?>

</div>

<?php
	include('inc/footer.inc.php');
?>