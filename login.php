<?php

  session_start();
  require_once('pdo.php');
  if(isset($_POST["login"])){
    $sql="SELECT COUNT(infoID),infoID FROM infodesk WHERE iusername=:iu AND ipass=:ip";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
      ':iu'=>$_POST["iuser"],
      ':ip'=>$_POST["ipass"]
    ));
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    if($result["COUNT(infoID)"]>0){
      $sql="SELECT COUNT(sysID),sysID FROM sysadmin WHERE susername=:su AND spass=:sp";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(array(
        ':su'=>$_POST["suser"],
        ':sp'=>$_POST["spass"]
      ));
      $result1=$stmt->fetch(PDO::FETCH_ASSOC);
      if($result1["COUNT(sysID)"]>0){
        $_SESSION["infoID"]=$result["infoID"];
        $_SESSION["sysID"]=$result1["sysID"];
        $sql="INSERT INTO logintime(infoID,sysID) VALUES(:info,:sy)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
          ':info'=>$result["infoID"],
          ':sy'=>$result1["sysID"]
        ));
        header('Location:view.php');
        return;
      }
      else{
        $_SESSION["error"]="Sysadmin User not found. Please recheck credentials.";
        header('Location:login.php');
        return;
      }
    }
    else{
      $_SESSION["error"]="Infodesk User not found. Please recheck credentials.";
      header('Location:login.php');
      return;
    }
  }

 ?>

<html>
  <head>
    <title>TT'18|Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body style="padding:20px">
    <?php
      if(isset($_SESSION["error"])){
        echo $_SESSION["error"];
        unset($_SESSION["error"]);
      }
     ?>
     <p>Login to confirm payments</p>
    <form method="post" action="login.php">
      <div class="form-group">
      Infodesk Username <input type="text" required="required" name="iuser" placeholder="Infodesk ID" style="border:0;background-color: rgba(0,0,0,0.1);padding:1 0 1 10;margin:5px;border-radius:20px"><br>
      Infodesk Password <input type="password" required="required" name="ipass" placeholder="Infodesk Pass" style="border:0;background-color: rgba(0,0,0,0.1);padding:1 0 1 10;margin:5px;border-radius:20px"><br>
      </div>
      <div class="form-group">
      Sysadmin Username <input type="text" required="required" name="suser" placeholder="Sysadmin ID" style="border:0;background-color: rgba(0,0,0,0.1);padding:1 0 1 10;margin:5px;border-radius:20px"><br>
      Sysadmin Password <input type="password" required="required" name="spass" placeholder="Sysadmin Pass" style="border:0;background-color: rgba(0,0,0,0.1);padding:1 0 1 10;margin:5px;border-radius:20px"><br>
      </div>
      <input class="btn btn-primary" type="submit" name="login" value="Continue">
    </form>
  </body>
</html>
