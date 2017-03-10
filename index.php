<?php
	header('Content-type: text/html; charset:utf8');
	include('inc/header.inc.php');
	include('inc/connect.inc.php');
?>

<div id="menu">
	<ul>
		<li><a href="index.php" style="background-color:#5bd75b">Home</a></li>
		<li><a href="pharmacy.php">Pharmacies</a></li>
		<li><a href="medicine.php">Medicines</a></li>
		<li><a href="company.php">P. Companies</a></li>
		<li><a href="doctor.php">Doctors</a></li>
		<li><a href="patient.php">Patients</a></li>
	</ul>
</div>

<div id="welcome">
	<center><span><b>Welcome to <i>Prescriptions-R-X.</i></b></span></center>
	<br/>
	<p><u>Navigation</u> :</p>
	<ul>
		<li><a href="pharmacy.php">Pharmacies</a>: for information regarding our pharmacies.</li>
		<li><a href="medicine.php">Medicines</a>: for information regarding our suppling medicines.</li>
		<li><a href="company.php">P. Companies</a>: for information regarding our contracted pharmaceutical companies.</li>
		<li><a href="doctor.php">Doctors</a>: for information regarding our contracted doctors.</li>
		<li><a href="patient.php">Patients</a>: for information regarding our pharmacies.</li>
	</ul>

<?php
	$sql1="SELECT COUNT(PharmacyId) as pharmacies FROM Pharmacy";
	$data=mysql_query($sql1,$con);
	$rec=mysql_fetch_array($data);
	
	$sql2="select avg(ExperienceYears) as avgyears, count(DoctorId) as doctors from Doctor";
	$data1=mysql_query($sql2,$con);
	$rec1=mysql_fetch_array($data1);
	
	$sql3="select avg(tmp.c) as avgmeds
			from (
			SELECT count(Drug.DrugId) as c
			from ((Pharmacy inner join Sell on (Pharmacy.PharmacyId=Sell.PharmacyId)) inner join Drug on Sell.DrugId=Drug.DrugId)
			group by Pharmacy.PharmacyId
			) as tmp";
	$data2=mysql_query($sql3,$con);
	$rec2=mysql_fetch_array($data2);

	echo"
		<div>
			<br/><br/>
			<p><u>Information regarding our company</u> :</p>
			<ul>
				<li>Our company has <b>".$rec['pharmacies']." pharmacies</b>.</li>
				<li>We collaborate with <b>".$rec1['doctors']." contracted doctors</b> with average <b>" .round($rec1['avgyears'],3). " years of experience</b>.</li>
				<li>Each pharmacy supplies an average of <b>" .round($rec2['avgmeds'],2). " different medicines</b>.</li>
			</ul>
		</div>
	</div>";
?>

<?php
	include('inc/footer.inc.php');
?>