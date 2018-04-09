<?php
include_once('connection.php');



/*Function to insert image name into db*/
function InsertImageName($ImageName,$con){
	$sql = "insert into plant_photos (photo_name) values('$ImageName');";
	if($con->query($sql) === TRUE){
		return true;
	}else{
		return false;
	}
}

/*Function to check user logged in or not*/
function checkLoggedIn(){
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	if(isset($_SESSION['as_uname']) AND isset($_SESSION['as_uni_no'])){
		return true;
	}else{
		return false;
	}
}
/*Function to  check valid user accessing the pages*/
function isValidUserLoggedIn($role){
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	if(isset($_SESSION['as_play'])){
		if ($_SESSION['as_play'] == $role)
			return true;
		else
			return false;
	}else{
		return false;
	}
}


/* Function to check login */
function confirmUser($usern,$passw,$con){
	$squery = "select * from login where username = '".$usern."' and password = '".$passw."';";
	$result = $con->query($squery);
	if($result->num_rows ==1){
		$row = $result->fetch_assoc();
		createsessions($row['username'],$row['password'],$row['role']);
		return true;
	}else{
		return false;
	}
}

/*Function to logout user and redirect to home page*/
function logout_user(){
	clearsessionscookies();
}

function logutPagePath($rootPath){
	return $rootPath."index.php";
}
/* Function to createsession*/
function createsessions($as_uname,$as_pass,$as_role){
	//session_register();
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	$_SESSION['as_uname']=$as_uname;//storing username in as_uname variable
	$_SESSION['as_uni_no']=$as_pass;//Storing password in as_uni_no variable
	$_SESSION['as_play']=$as_role;//Storing role in as_play variable	
	
	/* if(isset($_POST['remme'])) 
    { 
        //Add additional member to cookie array as per requirement 
        setcookie("username", $_SESSION['username'], time()+60*60*24*100, "/"); 
        setcookie("password", $_SESSION['password'], time()+60*60*24*100, "/"); 
        return; 
    } */
}
/* Function to clearsession */
function clearsessionscookies() 
{
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    unset($_SESSION['as_uname']); 
    unset($_SESSION['as_uni_no']); 
    unset($_SESSION['as_play']);
    
    session_unset();     
    session_destroy();  
/*
    setcookie ("username", "",time()-60*60*24*100, "/"); 
    setcookie ("password", "",time()-60*60*24*100, "/"); */
}


/*Function to check user already registed wiht provided email id or not */
function DoesEmailAlreadyExit($email,$con){
	$squery = "select user_email from pending_users where user_email = '".$email."';";
	$result = $con->query($squery);
	if($result->num_rows >0){
		echo "select queur";
		return true;
	}else{
		//echo "sample".$result;
		return false;
	}
}
/*Function to check whether user already exit with same fullname or not*/
function  DoesFullnameAlreadyExit($fname,$mname,$lname,$con){
	$squery = "select user_email from pending_users where firstname = '".$fname."' and middlename = '".$mname."' and lastname = '".$lname."';";
	$result = $con->query($squery);
	if($result->num_rows >0){
		return true;
	}else{
		return false;
	}
}

/*Function to insert new user first time registration data*/
function InsertNewUserRecord($fname,$mname,$lname,$email,$con){
	$sql = "insert into pending_users (firstname,middlename,lastname,user_email) values('$fname','$mname','$lname','$email');";
	if($con->query($sql) === TRUE){
		return true;
	}else{
		return false;
	}

}

/*Function to redirect to dashboad based on users role*/
function UserDashboardPath($rootPath){
	//session_start();
	$redirect_page_id = $_SESSION['as_play'];
	if($redirect_page_id =='1'){
		return $rootPath."pages/dashboad.php";
	}
}

/*Function load css file */
function load_css($root_path,$files){
	foreach($files as $file){
		echo "<link href='".$root_path."assets/css/$file' rel='stylesheet'>";
	}
}

/*Function to load jquery files*/
function load_js($root_path,$files){
	foreach($files as $file){
		echo "<script src='".$root_path."assets/js/$file'></script>";
	}
}
?>