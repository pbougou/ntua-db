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
		<li><a href="addCompany.php">Add P. Company</a></li>
		<li><a href="companyPharmacies.php">Associated Pharmacies</a></li>
		<li><a href="companyMedicines.php" style="background-color:#5bd75b">Products</a></li>
	</ul>
</div>
<br/><br/>

<?php
echo"
<form id='form1' method='post' action='companyMedicines.php'>
<fieldset>
	<legend>Select a Pharmaceutical Company :</legend>

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

	<label for='submit1' id='submit'>
		<input id='submit1' class='submit' type='submit' name='search' value='Submit'/>
	</label>

</fieldset>
</form><br/><br/>";

if (isset($_POST['search'])) {
	if (empty($_POST['companyid'])) {
		echo "<p style='font-size:18px'><b>Warning: No company selected. Please pick one from the list.</b></p><br/><br/>";
	}
	else {
			$sql1= "SELECT Drug.Name, Drug.Formula
					FROM (Drug inner join Company on Drug.CompanyId=Company.CompanyId)
					WHERE Company.CompanyId='$_POST[companyid]'";
			$mydata1 = mysql_query($sql1,$con);

			$sql2= "SELECT Company.Name FROM Company WHERE Company.CompanyId='$_POST[companyid]'";
			$mydata2 = mysql_query($sql2,$con);
			$record2 = mysql_result ($mydata2,0);

			echo "<p><b>Medicines the company <u>".$record2."</u> manufactures: </b></p>
			<table width='90%'>
			<tr style='background-color:#FFFFF0'>
				<th>Medicine Name</th>
				<th>Medicine Formula</th>
			</tr>";
			while ($record1 = mysql_fetch_array($mydata1)){
				echo "
				<tr>
				<td>$record1[Name]</td>
				<td>$record1[Formula]</td>
				</tr>";
			}
			echo "</table>";
	}
}
?>

</div>

<?php
	include('inc/footer.inc.php');
?>