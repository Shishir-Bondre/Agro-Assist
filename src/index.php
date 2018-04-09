<?php
  $root_path = '';
  include_once($root_path.'includes/function.php');
    if(checkLoggedIn()==true){
        session_start();
        $redirect_page_id = $_SESSION['as_play'];
        if($redirect_page_id =='1'){
          header("Location:private_pages/dashboard.php");
        }else {
          header("Location:private_pages/dashboard.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Agro Assist</title>
  <!--Import Google Icon Font-->
  <link href="assets/css/material-icon.css" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
  <link href="assets/css/custom.css" rel="stylesheet">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style type="text/css">
    html,
    body {
        height: 100%;
    }
    html {
        display: table;
        margin: auto;
    }
    body {
        display: table-cell;
        vertical-align: middle;
    }
    .margin {
      margin: 0 !important;
    }
    .error{
      margin-left: 10px ;
      padding:2px;
      color: red !important;
    }
  </style>
</head>
<body class="indigo">
    <br>
    <center>
      <a href="index.php" class="btn orange waves-light waves-effect ">Agro Assist</a>
    </center>
    <div id="login-page" class="row">
      <div class="col s12 z-depth-6 card-panel" id="login-card">
        
        <form class="login-form" name="login_form" id="login_form" method="POST" action="includes/process_login.php" autocomplete="off">
          
          <div class="row">
            <div class="input-field col s12 center z-depth-6 ">
              <img src="assets/img/default-user.png" style="width:100px;
    height:auto;border-radius:50%;" alt="" class="responsive-img valign profile-image-login">
              <p class="center login-form-text flow-text">Login Form</p>
            </div>
          </div>
          <div class="divider"></div>
          <?php
            if(isset($_GET['err']))
            {
          ?>
            <div class="row margin">
              <div class="input-field col s12">
                <p id="erorMSG" style="color: red;marin:3px;"><?php echo $_GET['err'];?></p>
              </div>
            </div>
          <?php
            }
          ?>
          <div class="row margin">
            <div class="input-field col s12">
              <input placeholder="Placeholder" id="username" name="username" type="text" class="validate">
              <label for="first_name">User Name</label>
            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12">
              <input placeholder="Placeholder" id="password" name="password" type="password" class="validate">
              <label for="first_name">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input type="submit" value="Login" class="btn green col s12">
            </div> 
            <div class="input-field col s6">
              <input type="reset" class="btn blue col s12" name="Clear" value="Clear">
            </div>
          </div>
          <!-- <div class="row">
            <div class="input-field col s12 m6 l6">
              <p class="margin center medium-small sign-up">Password forgot ?<a href="password-fotgot.php"> Reset</a></p>
            </div>
            <div class="input-field col s12 m6 l6">
              <p class="margin center medium-small sign-up">Not Yet Registered?<a href="register.php">Register</a></p>
            </div>
          </div> -->
        </form>
    </div>
  </div>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/materialize.js"></script>
  <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
  <script type="text/javascript" src="assets/js/validate.js"></script>
  <script type="text/javascript" src="assets/js/pattern.js"></script>
  <script type="text/javascript" src="assets/js/testomeny_val.js"></script>
  
  <script type="text/javascript">
   $(document).ready(function(){
      loginFormValidate();
   });
  </script>
</body>
</html>
