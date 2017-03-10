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
		<li><a href="company.php" style="background-color:#5bd75b">Summary</a></li>
		<li><a href="addCompany.php">Add P. Company</a></li>
		<li><a href="companyPharmacies.php">Associated Pharmacies</a></li>
		<li><a href="companyMedicines.php">Products</a></li>
	</ul>
</div>
<br/><br/>

<?php
	if (isset($_POST['delete1'])) {
		$deleteQuery="DELETE FROM Company WHERE CompanyId='$_POST[hidden1]'";
		mysql_query($deleteQuery, $con);
	}

	if (isset($_POST['update1'])) {
		if ( (empty($_POST['name'])) or empty($_POST['pnumber']) ) {
			echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
		}
		else {
			$updateQuery="UPDATE Company
						  SET Name='$_POST[name]',PhoneNumber='$_POST[pnumber]'
						  WHERE CompanyId='$_POST[hidden2]'";
			mysql_query($updateQuery, $con);
		}
	}

	$sql1="SELECT * FROM Company";
	$mydata1 = mysql_query($sql1,$con);
	echo "<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>ID</th>
		<th>Name</th>
		<th>Phone Number</th>
	</tr>";
	while ($record1 = mysql_fetch_array($mydata1)){
		echo "<form action='company.php' method='POST'>
		<tr>
		<td>$record1[CompanyId]</td>
		<td><input type='text' name='name' value='$record1[Name]' /></td>
		<td><input type='text' name='pnumber' value='$record1[PhoneNumber]' /></td>
		<td width='5%'>
			<input type='hidden' name='hidden1' value='$record1[CompanyId]'/>
			<input type='submit' name='delete1' value='Delete'/>
		</td>
		<td width='5%'>
			<input type='hidden' name='hidden2' value='$record1[CompanyId]'/>
			<input type='submit' name='update1' value='Update'/>
		</td>
		</tr></form>";
	}
	echo "</table>";
?>

</div>

<?php
	include('inc/footer.inc.php');
?>