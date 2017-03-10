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
		<li><a href="addMedicine.php">Add Medicine</a></li>
		<li><a href="medicineSearch.php" style="background-color:#5bd75b">Find Medicine</a></li>
	</ul>
</div>
<br/><br/>

<?php
echo "
<form id='form1' method='post' action='medicineSearch.php'>
<fieldset>
	<legend>Find drugs with a specific formula :</legend>

	<label for='formula'>
		<span>Drug Formula :</span>
		<select name='formula'>
			<option value='' disabled selected>Select Formula</option>";
				$sql2="SELECT DISTINCT Drug.Formula FROM Drug";
				$mydata2=mysql_query($sql2, $con);
				while ($record2 = mysql_fetch_assoc($mydata2)) {
					$formula=$record2['Formula'];
					echo "<option value='$formula'>".$formula ."</option>";
				}
				echo"</select>
	</label>

	<label for='submit1' id='submit'>
		<input id='submit1' class='submit' type='submit' name='search1' value='Submit'/>
	</label>

</fieldset>
</form><br/><br/><br/>";

if (isset($_POST['search1'])) {
	if (empty($_POST['formula'])) {
		echo "<p style='font-size:18px'><b>Warning: You must select a formula from the list.</b></p><br/><br/>";
	}
	else {
			$sql1= "SELECT Drug.Name, Drug.CompanyId
					FROM Drug
					WHERE Drug.Name IN (
						SELECT Name
						FROM Drug
						WHERE Formula='$_POST[formula]'
					)";
			$mydata1 = mysql_query($sql1,$con);

			if (mysql_num_rows($mydata1)!=0) {
				echo "
				<p><b>Drugs with the formula <u>".$_POST['formula']."</u>: </b></p>
				<table width='90%'>
				<tr style='background-color:#FFFFF0'>
					<th>Medicine Name</th>
					<th>Pharmaceutical Company</th>
				</tr>";
				while ($record1 = mysql_fetch_array($mydata1)){
					$sql3= "SELECT Company.Name FROM Company WHERE Company.CompanyId='$record1[CompanyId]'";
					$mydata3 = mysql_query($sql3,$con);
					$record3 = mysql_result ($mydata3,0);
					echo "
					<tr>
					<td>$record1[Name]</td>
					<td>$record3</td>
					</tr>";
				}
				echo "</table><br/><br/><br/>";
			}
			else {
				echo "<p style='font-size:18px'><b>No drugs found with that formula.</b></p><br/><br/><br/>";
			}
	}
}
?>

</div>

<?php
	include('inc/footer.inc.php');
?>