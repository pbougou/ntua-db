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
		<li><a href="doctor.php">Summary</a></li>
		<li><a href="doctorSearch.php">Find Doctor</a></li>
		<li><a href="doctorDrugs.php" style="background-color:#5bd75b">Prescribed Drug Quantities</a></li>
	</ul>
</div>
<br/><br/>

<?php

echo "
<form id='form1' method='post' action='doctorDrugs.php'>
<fieldset>
	<legend>Select a doctor :</legend>

	<label for='doctorid'>
		<span>Doctor :</span>
		<select name='doctorid'>
			<option value='' disabled selected>Select Doctor</option>";
				$sql2="SELECT Doctor.DoctorId, Doctor.FirstName, Doctor.LastName FROM Doctor";
				$mydata2=mysql_query($sql2, $con);
				while ($record2 = mysql_fetch_assoc($mydata2)) {
					$did=$record2['DoctorId'];
					$dfn=$record2['FirstName'];
					$dln=$record2['LastName'];
					echo "<option value='$did'>".$did." : ".$dfn." ".$dln."</option>";
				}
				echo"</select>
	</label>

	<label for='submit1' id='submit'>
		<input id='submit1' class='submit' type='submit' name='search1' value='Submit'/>
	</label>

</fieldset>
</form><br/><br/><br/>";

if (isset($_POST['search1'])) {
	if (empty($_POST['doctorid'])) {
		echo "<p style='font-size:18px'><b>Warning: You must select a doctor from the list.</b></p><br/><br/>";
	}
	else {
		$sql1= "SELECT Doctor.FirstName, Doctor.LastName, Doctor.Speciality, sum(Prescription.Quantity) as amount
				FROM (Doctor inner join Prescription on Doctor.DoctorId=Prescription.DoctorId) 
					  inner join Patient on (Prescription.PatientId=Patient.PatientId)
				WHERE Doctor.DoctorId = '$_POST[doctorid]'";
		$mydata1 = mysql_query($sql1,$con);

		if (mysql_num_rows($mydata1)!=0) {
			echo "
			<table width='90%'>
			<tr style='background-color:#FFFFF0'>
				<th>Doctor</th>
				<th>Specialty</th>
				<th>Total amount of prescribed Drugs</th>
			</tr>";
			while ($record1 = mysql_fetch_array($mydata1)){
				if (empty($record1['amount'])) {
					$record1['amount']=0;
				}
				echo "
				<tr>
				<td>$record1[FirstName] $record1[LastName]</td>
				<td>$record1[Speciality]</td>
				<td>$record1[amount]</td>
				</tr>";
			}
			echo "</table><br/><br/><br/>";
		}
		else {
			echo "<p style='font-size:18px'><b>The doctor doesn't exist.</b></p><br/><br/><br/>";
		}
	}
}

?>

</div>

<?php
	include('inc/footer.inc.php');
?>