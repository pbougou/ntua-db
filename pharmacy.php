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
		<li><a href="pharmacy.php" style="background-color:#5bd75b">Summary</a></li>
		<li><a href="addPharmacy.php">Add Pharmacy</a></li>
		<li><a href="pharmacySupplies.php">Medicine supplies</a></li>
		<li><a href="pharmacyContracts.php">Contracts</a></li>
		<li><a href="pharmacySearch.php">Search Pharmacy</a></li>
	</ul>
</div>
<br/><br/>

<?php
	if(isset($_POST['delete1'])){
		$deleteQuery="DELETE FROM Pharmacy WHERE PharmacyId='$_POST[hidden1]'";
		mysql_query($deleteQuery, $con);
	}

	if(isset($_POST['update1'])){
		if ( (empty($_POST['name'])) or empty($_POST['town']) or empty($_POST['adrstrname']) or empty($_POST['adrstrno']) or empty($_POST['adrpcode']) or empty($_POST['phnumber']) ) {
			echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
		}
		else {
			$updateQuery="UPDATE Pharmacy
						  SET Name='$_POST[name]',Town='$_POST[town]',StreetName='$_POST[adrstrname]',
						  	  StreetNumber='$_POST[adrstrno]',PostalCode='$_POST[adrpcode]',
						  	  PhoneNumber='$_POST[phnumber]'
						  WHERE PharmacyId='$_POST[hidden2]'";
			mysql_query($updateQuery, $con);
		}
	}

	$sql1="SELECT * FROM Pharmacy";
	$mydata1 = mysql_query($sql1,$con);
	echo "<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>ID</th>
		<th>Pharmacy Name</th>
		<th>Town</th>
		<th>Street</th>
		<th>Number</th>
		<th>Postal Code</th>
		<th>Phone Number</th>
	</tr>";

	while ($record1 = mysql_fetch_array($mydata1)){
		echo "<form action='pharmacy.php' method='POST'>
		<tr>
		<td>$record1[PharmacyId]</td>
		<td><input type='text' name='name' value='$record1[Name]' /></td>
		<td><input type='text' name='town' value='$record1[Town]' /></td>
		<td><input type='text' name='adrstrname' value='$record1[StreetName]' /></td>
		<td><input type='text' name='adrstrno' value='$record1[StreetNumber]' /></td>
		<td><input type='text' name='adrpcode' value='$record1[PostalCode]' /></td>
		<td><input type='text' name='phnumber' value='$record1[PhoneNumber]' /></td>
		<td width='5%'>
			<input type='hidden' name='hidden1' value='$record1[PharmacyId]'/>
			<input type='submit' name='delete1' value='Delete'/>
		</td>
		<td width='5%'>
			<input type='hidden' name='hidden2' value='$record1[PharmacyId]'/>
			<input type='submit' name='update1' value='Update'/>
		</td>
		</tr></form>";
	}
	echo"</table>";
?>

</div>

<?php
	include('inc/footer.inc.php');
?>