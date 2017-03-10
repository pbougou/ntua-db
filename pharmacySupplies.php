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
		<li><a href="pharmacySupplies.php" style="background-color:#5bd75b">Medicine supplies</a></li>
		<li><a href="pharmacyContracts.php">Contracts</a></li>
		<li><a href="pharmacySearch.php">Search Pharmacy</a></li>
	</ul>
</div>
<br/><br/>

<?php
if (isset($_POST['addnew'])) {
	if ( (empty($_POST['pharmacyid'])) or (empty($_POST['drugid'])) or (empty($_POST['price'])) ) {
		echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
	}
	else {
		$addQuery="INSERT INTO Sell (PharmacyId, DrugId, Price)	
				   VALUES ('$_POST[pharmacyid]','$_POST[drugid]','$_POST[price]')";
		mysql_query($addQuery, $con);
	}
}

$sql1="SELECT * FROM Sell";
$mydata1 = mysql_query($sql1,$con);
echo "<table width='90%'>
<tr style='background-color:#FFFFF0'>
	<th width='7%'>Pharmacy ID</th>
	<th width='7%'>Drug ID</th>	
	<th>Pharmacy</th>
	<th>Drug</th>
	<th>Price</th>
</tr>";
while ($record1 = mysql_fetch_array($mydata1)){
	$sql4="SELECT Pharmacy.Name FROM Pharmacy WHERE Pharmacy.PharmacyId='$record1[PharmacyId]'";
	$sql5="SELECT Drug.Name FROM Drug WHERE Drug.DrugId='$record1[DrugId]'";
	$mydata4 = mysql_query($sql4,$con);
	$mydata5 = mysql_query($sql5,$con);
	$pname = mysql_result($mydata4, 0);
	$dname = mysql_result($mydata5, 0);
	echo "
	<tr>
	<td>$record1[PharmacyId]</td>
	<td>$record1[DrugId]</td>
	<td>$pname</td>
	<td>$dname</td>
	<td>$record1[Price]</td>
	</tr>";
}
echo"</table><br/><br/>";

echo "
<form id='form1' method='post' action='pharmacySupplies.php'>
<fieldset>
	<legend>Add new Supply in the database :</legend>

	<label for='pharmacyid'>
		<span>Pharmacy :</span>
		<select name='pharmacyid'>
			<option value='' disabled selected>Select Pharmacy</option>";
				$sql2="SELECT Pharmacy.PharmacyId, Pharmacy.Name FROM Pharmacy";
				$mydata2=mysql_query($sql2, $con);
				while ($record2 = mysql_fetch_assoc($mydata2)) {
					$pid=$record2['PharmacyId'];
					$pname=$record2['Name'];
					echo "<option value='$pid'>" .$pid ." : ".$pname."</option>";
				}
				echo"</select>
	</label>

	<label for='drugid'>
		<span>Medicine :</span>
		<select name='drugid'>
			<option value='' disabled selected>Select Medicine</option>";
				$sql3="SELECT Drug.DrugId, Drug.Name FROM Drug";
				$mydata3=mysql_query($sql3, $con);
				while ($record3 = mysql_fetch_assoc($mydata3)) {
					$did=$record3['DrugId'];
					$dname=$record3['Name'];
					echo "<option value='$did'>" .$did ." : ".$dname."</option>";
				}
				echo"</select>
	</label>

	<label for='price'>
		<span>Medicine price :</span>
		<input id='price' type='text' name='price' size='20'/>
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