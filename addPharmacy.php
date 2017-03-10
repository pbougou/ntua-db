<?php 
	header('Content-type: text/html; charset:utf8');
	include('inc/header.inc.php');
	include('inc/connect.inc.php');
?>

<div id="menu">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="pharmacy.php" style="background-color:#5bd75b">Pharmacies</a></li>
		<li><a href="medicine.php">Medicines</a></li>
		<li><a href="company.php">P. Companies</a></li>
		<li><a href="doctor.php">Doctors</a></li>
		<li><a href="patient.php">Patients</a></li>
	</ul>
</div>

<div id="main">

<div id="menu2">
	<ul>
		<li><a href="pharmacy.php">Summary</a></li>
		<li><a href="addPharmacy.php" style="background-color:#5bd75b">Add Pharmacy</a></li>
		<li><a href="pharmacySupplies.php">Medicine supplies</a></li>
		<li><a href="pharmacyContracts.php">Contracts</a></li>
		<li><a href="pharmacySearch.php">Search Pharmacy</a></li>
	</ul>
</div>
<br/><br/>

<?php
if (isset($_POST['addnew'])) {
	if ( (empty($_POST['name'])) or empty($_POST['town']) or empty($_POST['adrstrname']) or empty($_POST['adrstrno']) or empty($_POST['adrpcode']) or empty($_POST['phnumber']) ) {
		echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
	}
	else {
		$addQuery="INSERT INTO Pharmacy (Name, Town ,StreetName, StreetNumber, PostalCode, PhoneNumber)		
					VALUES ('$_POST[name]','$_POST[town]','$_POST[adrstrname]','$_POST[adrstrno]','$_POST[adrpcode]','$_POST[phnumber]')";
		mysql_query($addQuery, $con);
	}
}

echo"
<form id='form1' method='post' action='addPharmacy.php'>
<fieldset>
	<legend>Add new Pharmacy in the database :</legend>

	<label for='name'>
		<span>Pharmacy Name :</span>
		<input id='name' type='text' name='name' size='20'/>
	</label>

	<label for='town'>
		<span>Town :</span>
		<input id='town' type='text' name='town' size='20'/>
	</label>

	<label for='adrstrname'>
		<span>Street Name :</span>
		<input id='adrstrname' type='text' name='adrstrname' size='20'/>
	</label>

	<label for='adrstrno'>
		<span>Street Number :</span>
		<input id='adrstrno' type='text' name='adrstrno' size='20'/>
	</label>

	<label for='adrpcode'>
		<span>Postal Code :</span>
		<input id='adrpcode' type='text' name='adrpcode' size='20'/>
	</label>

	<label for='phnumber'>
		<span>Phone Number :</span>
		<input id='phnumber' type='text' name='phnumber' size='20'/>
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