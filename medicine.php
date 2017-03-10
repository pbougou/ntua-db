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
		<li><a href="medicine.php" style="background-color:#5bd75b">Summary</a></li>
		<li><a href="addMedicine.php">Add Medicine</a></li>
		<li><a href="medicineSearch.php">Find Medicine</a></li>
	</ul>
</div>
<br/><br/>

<?php
	if (isset($_POST['delete1'])) {
		$deleteQuery="DELETE FROM Drug WHERE DrugId='$_POST[hidden1]'";
		mysql_query($deleteQuery, $con);
	}

	if (isset($_POST['update1'])) {
		if ( (empty($_POST['name'])) or empty($_POST['formula']) or empty($_POST['companyid']) ) {
			echo "<p style='font-size:18px'><b>Warning: All the fields are required. Please try again.</b></p><br/><br/>";
		}
		else {
			$updateQuery="UPDATE Drug
						  SET Name='$_POST[name]',Formula='$_POST[formula]',
						  	  CompanyId='$_POST[companyid]'
						  WHERE DrugId='$_POST[hidden2]'";
			mysql_query($updateQuery, $con);
		}
	}

	$sql1="SELECT * FROM Drug";
	$mydata1 = mysql_query($sql1,$con);
	echo "<table width='90%'>
	<tr style='background-color:#FFFFF0'>
		<th>ID</th>
		<th>Name</th>
		<th>Formula</th>
		<th colspan='2'>Pharmaceutical Company</th>
	</tr>";
	while ($record1 = mysql_fetch_array($mydata1)){
		echo "<form action='medicine.php' method='POST'>
		<tr>
		<td>$record1[DrugId]</td>
		<td><input type='text' name='name' value='$record1[Name]' /></td>
		<td><input type='text' name='formula' value='$record1[Formula]' /></td>
		<td>";
		$sql2="SELECT Company.Name FROM Company
			   WHERE Company.CompanyId='$record1[CompanyId]'";
		$mydata2=mysql_fetch_assoc(mysql_query($sql2,$con));
		$record2=$mydata2['Name'];
		echo "$record2</td>
		<td width='8%' border='0'>
			<select name='companyid'>
			<option value='$record1[CompanyId]' selected>Select Company</option>";

			$sql3="SELECT Company.CompanyId, Company.Name FROM Company";
				$mydata3=mysql_query($sql3, $con);
				while ($record3 = mysql_fetch_assoc($mydata3)) {
					$cid=$record3['CompanyId'];
					$cname=$record3['Name'];
					echo "<option value='$cid'>" .$cid ." : ".$cname."</option>";
				}
			echo"</select>
		</td>
		<td width='5%'>
			<input type='hidden' name='hidden1' value='$record1[DrugId]'/>
			<input type='submit' name='delete1' value='Delete'/>
		</td>
		<td width='5%'>
			<input type='hidden' name='hidden2' value='$record1[DrugId]'/>
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