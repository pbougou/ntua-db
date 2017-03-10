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
		<li><a href="doctorSearch.php" style="background-color:#5bd75b">Find Doctor</a></li>
		<li><a href="doctorDrugs.php">Prescribed Drug Quantities</a></li>
	</ul>
</div>
<br/><br/>

<?php
echo "
<form id='form1' method='post' action='doctorSearch.php'>
<fieldset>
	<legend>Find doctors :</legend>

	<label for='speciality'>
		<span>Specialty :</span>
		<select name='speciality'>
			<option value='' disabled selected>Select Specialty</option>";
				$sql2="SELECT DISTINCT Doctor.Speciality FROM Doctor";
				$mydata2=mysql_query($sql2, $con);
				while ($record2 = mysql_fetch_assoc($mydata2)) {
					$spec=$record2['Speciality'];
					echo "<option value='$spec'>".$spec."</option>";
				}
				echo"</select>
	</label>

	<label for='expYears'>
		<span>Minimum Years of Experience :</span>
		<input id='expYears' type='text' name='expYears' size='20'/>
	</label>

	<label for='submit1' id='submit'>
		<input id='submit1' class='submit' type='submit' name='search1' value='Submit'/>
	</label>

</fieldset>
</form><br/><br/><br/>";

if (isset($_POST['search1'])) {
	if (empty($_POST['speciality']) or empty($_POST['expYears'])) {
		echo "<p style='font-size:18px'><b>Warning: You must select both a Specialty and a minimum of experience years.</b></p><br/><br/>";
	}
	else if (((int) $_POST['expYears']) <= 0) {
		echo "<p style='font-size:18px'><b>Warning: You must enter a number for experience years.</b></p><br/><br/>";
	}
	else {
		$sql1= "SELECT Doctor.FirstName, Doctor.LastName, Doctor.ExperienceYears
				FROM Doctor
				WHERE Speciality = '$_POST[speciality]' and ExperienceYears >= '$_POST[expYears]'
				ORDER BY ExperienceYears DESC";
		$mydata1 = mysql_query($sql1,$con);

		if (mysql_num_rows($mydata1)!=0) {
			echo "
			<p><b>List of doctors with a specialty as a <u>".$_POST['speciality']."</u><br/> and a minimum of <u>".$_POST['expYears']." years</u> of experience: </b></p>
			<table width='90%'>
			<tr style='background-color:#FFFFF0'>
				<th>Doctor</th>
				<th>Experience Years</th>
			</tr>";
			while ($record1 = mysql_fetch_array($mydata1)){
				echo "
				<tr>
				<td>$record1[FirstName] $record1[LastName]</td>
				<td>$record1[ExperienceYears]</td>
				</tr>";
			}
			echo "</table><br/><br/><br/>";
		}
		else {
			echo "<p style='font-size:18px'><b>No doctors found matching that criteria.</b></p><br/><br/><br/>";
		}
	}
}
?>

</div>

<?php
	include('inc/footer.inc.php');
?>