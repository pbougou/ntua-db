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
		<li><a href="company.php" style="background-color:#5bd75b">P. Companies</a></li>
		<li><a href="doctor.php">Doctors</a></li>
		<li><a href="patient.php">Patients</a></li>
	</ul>
</div>

<div id="main">

<div id="menu2">
	<ul>
		<li><a href="company.php">Summary</a></li>
		<li><a href="addCompany.php" style="background-color:#5bd75b">Add P. Company</a></li>
		<li><a href="companyPharmacies.php">Associated Pharmacies</a></li>
		<li><a href="companyMedicines.php">Products</a></li>
	</ul>
</div>
<br/><br/>

<?php
if (isset($_POST['addnew'])) {
	if ( (empty($_POST['name'])) or empty($_POST['pnumber']) ) {
		echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
	}
	else {
		$addQuery="INSERT INTO Company (Name, PhoneNumber)		
					VALUES ('$_POST[name]','$_POST[pnumber]')";
		mysql_query($addQuery, $con);
	}
}

echo"
<form id='form1' method='post' action='addCompany.php'>
<fieldset>
	<legend>Add new Pharmaceutical Company in the database :</legend>

	<label for='name'>
		<span>Company Name :</span>
		<input id='name' type='text' name='name' size='20'/>
	</label>

	<label for='pnumber'>
		<span>Phone Number :</span>
		<input id='pnumber' type='text' name='pnumber' size='20'/>
	</label>

	<label for='submit1' id='submit'>
		<input id='submit1' class='submit' type='submit' name='addnew' value='Submit'/>
	</label>

</fieldset>
</form>";

?>

</div>

<?php
	include('inc/footer.inc.php');
?>