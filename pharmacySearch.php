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
		<li><a href="addPharmacy.php">Add Pharmacy</a></li>
		<li><a href="pharmacySupplies.php">Medicine supplies</a></li>
		<li><a href="pharmacyContracts.php">Contracts</a></li>
		<li><a href="pharmacySearch.php" style="background-color:#5bd75b">Search Pharmacy</a></li>
	</ul>
</div>
<br/><br/>

<?php
echo "
<form id='form1' method='post' action='pharmacySearch.php'>
<fieldset>
	<legend>Locate pharmacies in your area :</legend>

	<label for='postalcode'>
		<span>Postal Code :</span>
		<input id='postalcode' type='text' name='postalcode' size='20'/>
	</label>

	<label for='submit1' id='submit'>
		<input id='submit1' class='submit' type='submit' name='search1' value='Submit'/>
	</label>

</fieldset>
</form><br/><br/><br/>";

if (isset($_POST['search1'])) {
	if (empty($_POST['postalcode'])) {
		echo "<p style='font-size:18px'><b>Warning: You must enter a valid Postal Code.</b></p><br/><br/>";
	}
	else {
			$sql1= "SELECT * FROM Pharmacy
					WHERE Pharmacy.PostalCode='$_POST[postalcode]'";
			$mydata1 = mysql_query($sql1,$con);

			if (mysql_num_rows($mydata1)!=0) {
				echo "
				<table width='90%'>
				<tr style='background-color:#FFFFF0'>
					<th>Pharmacy Name</th>
					<th>Address</th>
					<th>Town</th>
					<th>Phone Number</th>
				</tr>";
				while ($record1 = mysql_fetch_array($mydata1)){
					echo "
					<tr>
					<td>$record1[Name]</td>
					<td>$record1[StreetName] $record1[StreetNumber], $record1[PostalCode]</td>
					<td>$record1[Town]</td>
					<td>$record1[PhoneNumber]</td>
					</tr>";
				}
				echo "</table><br/><br/><br/>";
			}
			else {
				echo "<p style='font-size:18px'><b>No pharmacies found in your area.</b></p><br/><br/><br/>";
			}
	}
}

echo "
<form id='form1' method='post' action='pharmacySearch.php'>
<fieldset>
	<legend>Find pharmacies by average Drug Price :</legend>

	<label for='price'>
		<span>Average Drug Price :</span>
		<input id='price' type='text' name='price' size='20'/>
	</label>

	<label for='submit1' id='submit'>
		<input id='submit2' class='submit' type='submit' name='search2' value='Submit'/>
	</label>

</fieldset>
</form><br/><br/>";

if (isset($_POST['search2'])) {
	if (empty($_POST['price'])) {
		echo "<p style='font-size:18px'><b>Warning: You must enter a price.</b></p><br/><br/>";
	}
	else {
			$sql2= "SELECT Pharmacy.Name, avg(Sell.Price) as avgPrice, Pharmacy.StreetName, Pharmacy.StreetNumber,
						   Pharmacy.PostalCode, Pharmacy.Town, Pharmacy.PhoneNumber
					FROM ((Pharmacy inner join Sell on (Pharmacy.PharmacyId=Sell.PharmacyId)) 
						   inner join Drug on Sell.DrugId=Drug.DrugId)
					GROUP BY Pharmacy.Name
					HAVING avg(Sell.Price) <= '$_POST[price]'";
			$mydata2 = mysql_query($sql2,$con);

			if (mysql_num_rows($mydata2)!=0) {
				echo "
				<table width='90%'>
				<tr style='background-color:#FFFFF0'>
					<th>Pharmacy Name</th>
					<th>Average Drug Price</th>
					<th>Address</th>
					<th>Town</th>
					<th>Phone Number</th>
				</tr>";
				while ($record1 = mysql_fetch_array($mydata2)){
					echo "
					<tr>
					<td>$record1[Name]</td>
					<td>$record1[avgPrice]</td>
					<td>$record1[StreetName] $record1[StreetNumber], $record1[PostalCode]</td>
					<td>$record1[Town]</td>
					<td>$record1[PhoneNumber]</td>
					</tr>";
				}
				echo "</table>";
			}
			else {
				echo "<p style='font-size:18px'><b>No pharmacies found with that average Drug Price.</b></p>";
			}
	}
}
?>

</div>

<?php
	include('inc/footer.inc.php');
?>