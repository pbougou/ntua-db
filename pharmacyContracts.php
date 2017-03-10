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
		<li><a href="pharmacyContracts.php" style="background-color:#5bd75b">Contracts</a></li>
		<li><a href="pharmacySearch.php">Search Pharmacy</a></li>
	</ul>
</div>
<br/><br/>

<?php
if (isset($_POST['addnew'])) {
	if ( (empty($_POST['pharmacyid'])) or (empty($_POST['companyid'])) or (empty($_POST['startDate'])) or
		 (empty($_POST['endDate'])) or (empty($_POST['supervisor'])) or (empty($_POST['contractText'])) ) {
		echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
	}
	else {
		$addQuery="INSERT INTO Contract (PharmacyId, CompanyId, StartDate, EndDate, ContractText, Supervisor)	
				   VALUES ('$_POST[pharmacyid]','$_POST[companyid]','$_POST[startDate]',
				   		   '$_POST[endDate]','$_POST[contractText]','$_POST[supervisor]')";
		mysql_query($addQuery, $con);
	}
}

if(isset($_POST['updateView'])){
	if ( (empty($_POST['v_startDate'])) or empty($_POST['v_endDate']) or empty($_POST['v_supervisor']) ) {
		echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
	}
	else {
		$updateQuery="UPDATE contractView
					  SET StartDate='$_POST[v_startDate]',EndDate='$_POST[v_endDate]',
					  	  Supervisor='$_POST[v_supervisor]'
					  WHERE PharmacyId='$_POST[hidden1]' and CompanyId='$_POST[hidden2]'";
		mysql_query($updateQuery, $con);
	}
}

if(isset($_POST['deleteView'])){
	$deleteQuery="DELETE FROM contractView WHERE PharmacyId='$_POST[hidden3]' and CompanyId='$_POST[hidden4]'";
	mysql_query($deleteQuery, $con);
}

echo "<p><b>Public Updatable View :</b></p>";

	$sql1="SELECT * FROM contractView";
	$mydata1 = mysql_query($sql1,$con);
	echo "<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>Pharmacy</th>
		<th>Pharmaceutical Company</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Contract Supervisor</th>
	</tr>";
	while ($record1 = mysql_fetch_array($mydata1)){
		echo "<form action='pharmacyContracts.php' method='POST'>
		<tr>
		<td>$record1[PharmacyId]</td>
		<td>$record1[CompanyId]</td>
		<td><input type='date' name='v_startDate' value='$record1[StartDate]' /></td>
		<td><input type='date' name='v_endDate' value='$record1[EndDate]' /></td>
		<td><input type='text' name='v_supervisor' value='$record1[Supervisor]' /></td>
		<td width='5%'>
			<input type='hidden' name='hidden1' value='$record1[PharmacyId]'/>
			<input type='hidden' name='hidden2' value='$record1[CompanyId]'/>
			<input type='submit' name='updateView' value='Update'/>
		</td>
		<td width='5%'>
			<input type='hidden' name='hidden3' value='$record1[PharmacyId]'/>
			<input type='hidden' name='hidden4' value='$record1[CompanyId]'/>
			<input type='submit' name='deleteView' value='Delete'/>
		</td>
		</tr></form>";
	}

echo "</table><br/><br/>
<p><b>Private Database Table :</b></p>";

	$sql2="SELECT * FROM Contract";
	$mydata2 = mysql_query($sql2,$con);
	echo "<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>Pharmacy</th>
		<th>Pharmaceutical Company</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Contract Supervisor</th>
		<th>Contract Text</th>
	</tr>";
	while ($record2 = mysql_fetch_array($mydata2)){
		echo "
		<tr>
		<td>$record2[PharmacyId]</td>
		<td>$record2[CompanyId]</td>
		<td>$record2[StartDate]</td>
		<td>$record2[EndDate]</td>
		<td>$record2[Supervisor]</td>
		<td>$record2[ContractText]</td>
		</tr>";
	}
echo "</table><br/><br/>";

echo "
<form id='form1' method='post' action='pharmacyContracts.php'>
<fieldset>
	<legend>Add new Contract in the database :</legend>

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

	<label for='companyid'>
		<span>Pharmaceutical Company :</span>
		<select name='companyid'>
			<option value='' disabled selected>Select Company</option>";
				$sql3="SELECT Company.CompanyId, Company.Name FROM Company";
				$mydata3=mysql_query($sql3, $con);
				while ($record3 = mysql_fetch_assoc($mydata3)) {
					$cid=$record3['CompanyId'];
					$cname=$record3['Name'];
					echo "<option value='$cid'>" .$cid ." : ".$cname."</option>";
				}
				echo"</select>
	</label>

	<label for='startDate'>
		<span>Contract Start Date :</span>
		<input id='startDate' type='date' name='startDate' size='20'/>
	</label>

	<label for='endDate'>
		<span>Contract End Date :</span>
		<input id='endDate' type='date' name='endDate' size='20'/>
	</label>

	<label for='supervisor'>
		<span>Contract Supervisor :</span>
		<input id='supervisor' type='text' name='supervisor' size='20'/>
	</label>

	<label for='contractText'>
		<span>Contract Text :</span>
		<input id='contractText' type='text' name='contractText' size='20'/>
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