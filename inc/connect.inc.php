<?php
	header('Content-type: text/html; charset: utf8');
	$con = mysql_connect("localhost","root","");
	mysql_query("SET NAMES 'utf8'", $con);
	if (!$con){
		die("Could not connect: " . mysql_error());
	}
	mysql_select_db("prescriptionsrx",$con);
?>