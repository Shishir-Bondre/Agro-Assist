<?php
  include_once('../includes/function.php');
  include_once('../includes/connection.php');
  include_once('../includes/reading_function.php');
  $root_path="../";
  if(checkLoggedIn()==false){
      header("Location:../index.php?err=Please login again");
  }

  $RecordDate = getLastRecordDate($con);
  $soilData = getSoilDataForDate($con, $RecordDate);
  //print_r($soilData);

  function loadDataSmoothly($con,$changedDate){
    $soilData = getSoilDataForDate($con, $changedDate);
  }
  /*Temperature humidity moisture reading*/
  $dht22_row =LastTempHumidityReading($con);
  $hygro_row =LastHygroReading($con);

  /*Temperature humidity moisture status code*/
 $tempHumidity = getTempHumdityStatus($con);
 $moisture = getMoistureStatus($con);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Agro Assist</title>
  <!--Import Google Icon Font-->
  <link href="../assets/css/material-icon.css" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../assets/css/materialize.css"  media="screen,projection"/>
  <link href="../assets/css/custom.css" rel="stylesheet">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <style type="text/css">
    body{
      background:linear-gradient(50deg, HSLA(205, 62%, 44%, 1), #F62D51);
    }
    li {
      border-bottom: thin solid gainsboro !important;
    }
    @media only screen and (max-width: 550px){
        #mob-logo{
          font-size: 1.3rem !important;
          margin-left: 6px !important;
        }
    }
    @media only screen and (min-width: 993px) and (max-width: 1050px) {
        #mob-logo{
          font-size: 1.8rem !important;
        }
    }
    header, main, footer,section {
      padding-left: 300px;
  }
  @media only screen and (max-width : 992px) {
    header, main, footer,section {
      padding-left: 0;
    }
  }
  </style>
</head>
<body>
<!-- =======Header start=========== -->
  <header>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper">
            <a href="#!" class="brand-logo center" id="mob-logo">&nbsp;Agro Assist</a>
            <a href="javascript:void(0);" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

            <ul id="nav-mobile" class="left hide-on-med-and-down">
              <!-- <li><a href="javascript:void(0);">Home</a></li> -->
              <li><a href="javascript:void(0);">Notifications<span class="new badge">5</span></a></li>
              <li><a class='dropdown-button waves-effect waves-light blue-grey darken-1' href='#' data-activates='dropdown1'>Account<i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
          </div>
        </nav>
      </div>
  </header>
  <!-- =======Header END=========== -->
  <!-- ===== start Dropdown Structure for desktop==== -->
  <ul id='dropdown1' class='dropdown-content'>
    
    <li><a href="../includes/logout.php">Logout</a></li>
  </ul>

<ul id='dropdown2' class='dropdown-content'>
    
    <li><a href="../includes/logout.php">Logout</a></li>
  </ul><!-- =====END Dropdown Structure for desktop==== -->
  <section>
  <div class="main">
    <!-- ======Outer Conatainer start======== -->
    <div class="container-fluid" style="min-height: 520px;">
      <!-- ===============Outer ROW Start============= -->
      <div class="row">
        <!-- =======Sidebar Slider Start========= -->
          <div class="col s8 m12 l12">
            <ul id="slide-out" class="side-nav fixed" id="side-nav_ul">
                <li>
                    <div class="userView">
                <div class="background">
                  <img src="../assets/img/b.jpg">
                </div>
                <a href="#!user">
                  <img class="circle" src="../assets/img/yuna.jpg">
                </a>
                <a class="dropdown-button" data-activates="dropdown2" style="cursor: pointer;">
                  <span class="white-text email">
                  <?php 
                    echo $_SESSION['as_uname'];
                   ?>
                  <i class="material-icons right">arrow_drop_down</i>
                  </span>
                </a>
            </div>
           </li>
          <li><a href="dashboard.php">Dashboard</a></li>
          <li class="active"><a href="javascript:void(0);">Soil</a></li>
            <li><a href="plant.php">Plant</a></li>
            <li><a href="assistance.php">Assistance</a></li>
            <li><a href="farmer.php">Farmers</a></li>
            <li>
              <a href="../includes/logout.php">Logout</a>
            </li>
          </ul>
          </div>
          <!-- =======Sidebar Slider END========= -->

          <!-- ==========Page content Start========= -->
        <div class="col s12 m12 l12">
        <div>
          <h5>Soil Survey</h5>
        </div>
        <div class="divider" style="opacity: .3"></div>
          <!-- =======First block-ROW Start======== -->
          <br>
          <!-- <div class="row">
            <div class="col s6 m4">
              <img src="../assets/img/soil.jpg" class="materialboxed" width="100%" style="border-radius: 50%;">
            </div>
            <div class="col s6 m4">
              <img src="../assets/img/soil.jpg" class="materialboxed" width="100%" style="border-radius: 50%;">
            </div>
            <div class="col s6 m4">
              <img src="../assets/img/soil.jpg" class="materialboxed" width="100%" style="border-radius: 50%;">
            </div>
          </div> -->
          <p class="flow-text center" style="color:white;">Last Survey
                <select class="col s6 m4 right teal" id="lastR_date">
                  <option value="" disabled>Choose Reading Date</option>
                <?php 
                  displayDateSelector($con,$RecordDate);
                ?>   
                </select>
          </p>
          <div class="row" id="DynamicData">
              <?php soilInitialData($con,$RecordDate);?>
          </div>
        <div class="divider" style="opacity: .3"></div>
      </div>
      <!-- ==========Page content END========= -->    
        </div>
        <!-- ===============Outer ROW END============= -->
       </div>
       <!-- ======Outer Conatainer END======== -->

  </div>
  <!-- =====Main div End===== -->
  </section>

  <?php 
    include_once('../includes/footer.php');
  ?>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="../assets/js/jquery.js"></script>
  <script type="text/javascript" src="../assets/js/materialize.js"></script>
  <script type="text/javascript" src="../assets/js/custom.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){

       /*$('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15 // Creates a dropdown of 15 years to control year
        });
*/
        $('select').material_select(function(e){
            var val2 =  $("option:selected").val();
            $.ajax({
              url:"../includes/ResponsedData.php",
              method:"POST",
              data:{lastR_date:val2},
              success:function($data){
                  $('#DynamicData').html($data);
              }
            });
            //alert(val2);
        });

      $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: true, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true, // Displays dropdown below the button
        alignment: 'right', // Displays dropdown with edge aligned to the left of button
        stopPropagation: true // Stops event propagation
     });
    });
  </script>
</body>
</html>