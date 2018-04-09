<?php
	include_once 'psl-config.php';
	//error_reporting(0);

	$con = new mysqli(HOST,USER,PASSW,DATABASE);

	if($con->connect_error){
		header('Location:../index.php?err=Unable to Connect to server');
		exit();
	}


?>