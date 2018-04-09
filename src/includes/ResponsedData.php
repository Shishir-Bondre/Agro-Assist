<?php
	include_once('reading_function.php');
	include_once('connection.php');
	$r_date = $_POST['lastR_date'];
	echo soilInitialData($con,$r_date);
?>