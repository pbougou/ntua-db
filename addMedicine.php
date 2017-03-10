<?php 
	header('Content-type: text/html; charset:utf8');
	include('inc/header.inc.php');
	include('inc/connect.inc.php');
?>

<div id="menu">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="pharmacy.php">Pharmacies</a></li>
		<li><a href="medicine.php" style="background-color:#5bd75b">Medicines</a></li>
		<li><a href="company.php">P. Companies</a></li>
		<li><a href="doctor.php">Doctors</a></li>
		<li><a href="patient.php">Patients</a></li>
	</ul>
</div>

<div id="main">

<div id="menu2">
	<ul>
		<li><a href="medicine.php">Summary</a></li>
		<li><a href="addMedicine.php" style="background-color:#5bd75b">Add Medicine</a></li>
		<li><a href="medicineSearch.php">Find Medicine</a></li>
	</ul>
</div>
<br/><br/>

<?php
if (isset($_POST['addnew'])) {
	if ( (empty($_POST['name'])) or empty($_POST['formula']) or empty($_POST['companyid']) ) {
		echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
	}
	else {
		$addQuery="INSERT INTO Drug (Name, Formula, CompanyId)		
					VALUES ('$_POST[name]','$_POST[formula]','$_POST[companyid]')";
		mysql_query($addQuery, $con);
	}
}

echo"
<form id='form1' method='post' action='addMedicine.php'>
<fieldset>
	<legend>Add new Medicine in the database :</legend>

	<label for='name'>
		<span>Medicine Name :</span>
		<input id='name' type='text' name='name' size='20'/>
	</label>

	<label for='formula'>
		<span>Formula :</span>
		<input id='formula' type='text' name='formula' size='20'/>
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