<?php
	include_once('connection.php');
	include_once 'function.php';

	if(isset($_POST['username']) && isset($_POST['password']))
	{
			$usern = $_POST['username'];
			$passw = md5($_POST['password']);
			if(confirmUser($usern,$passw,$con)==true){
				session_start();
				$redirect_page_id = $_SESSION['as_play'];
				if($redirect_page_id =='1'){
					header("Location:../private_pages/dashboard.php");
				}else{
					header("Location:../private_pages/dashboard.php");
				}
			}else{
				header('Location:../index.php?err=Username or password is  wrong');
			}
	}else{
		header("Location: ../index.php?err=Could not process login");
    		exit();
	}
?>