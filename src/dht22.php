<?php
date_default_timezone_set("Asia/Kolkata");
include "connect_user.php";
$h = htmlspecialchars($_GET["humidity"]);
$t = htmlspecialchars($_GET["temperature"]);
$time=date("h:i:s A");
$date=date("d/m/20y");
$msql="INSERT INTO `rnxgsgdj_argo-assist`.`dht22` (`date`,`time`,`humidity`, `temperature`) VALUES('$date','$time','$h','$t')";
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