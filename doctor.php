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
		<li><a href="doctor.php" style="background-color:#5bd75b">Doctors</a></li>
		<li><a href="patient.php">Patients</a></li>
	</ul>
</div>

<div id="main">

<div id="menu2">
	<ul>
		<li><a href="doctor.php" style="background-color:#5bd75b">Summary</a></li>
		<li><a href="doctorSearch.php">Find Doctor</a></li>
		<li><a href="doctorDrugs.php">Prescribed Drug Quantities</a></li>
	</ul>
</div>
<br/><br/>

<?php
	$sql1="SELECT * FROM Doctor";
	$mydata1 = mysql_query($sql1,$con);
	echo "<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>ID</th>
		<th>Name</th>
		<th>Specialty</th>
		<th>Experience Years</th>
	</tr>";
	while ($record1 = mysql_fetch_array($mydata1)){
		echo "
		<tr>
		<td>$record1[DoctorId]</td>
		<td>$record1[FirstName] $record1[LastName]</td>
		<td>$record1[Speciality]</td>
		<td>$record1[ExperienceYears]</td>
		</tr>";
	}
	echo "</table>";
?>

</div>

<?php
	include('inc/footer.inc.php');
?>