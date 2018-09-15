<?php

  session_start();
  require_once('pdo.php');
  $sql="UPDATE logintime SET logouttime=:l WHERE infoID=:i AND sysID=:s AND logouttime='0000-00-00 00:00:00'";
  $date = new DateTime();
  $dateFormat = $date->format('Y-m-d H:i:s');
  $stmt=$pdo->prepare($sql);
  $stmt->execute(array(
    ':l'=>$dateFormat,
    ':i'=>$_SESSION["infoID"],
    ':s'=>$_SESSION["sysID"]
  ));
  session_destroy();
  header('Location:login.php');
  return;

?>
