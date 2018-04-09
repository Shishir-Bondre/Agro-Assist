<?php
date_default_timezone_set("Asia/Kolkata");
include "connect_user.php";
$m = htmlspecialchars($_GET["moisture"]);
$time=date("h:i:s A");
$date=date("d/m/20y");
$msql="INSERT INTO `rnxgsgdj_argo-assist`.`hygrometer` (`date`,`time`,`moisture`) VALUES('$date','$time','$m')";
$rs=mysql_query($msql);
if($rs)
{
 echo "successfully added";
}
else
{
  echo mysql_error();
}
?>