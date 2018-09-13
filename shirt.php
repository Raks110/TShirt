<?php

  session_start();
  require_once('pdo.php');
  if(isset($_POST["continue"])){
    if(empty($_POST["name"])||(empty($_POST["reg"]))||empty($_POST["size"])||empty($_POST["phone"])){
        $_SESSION["error"]="Please don't leave any field empty.";
    }
    else{
      if(($_POST["phone"]/1000000000)<0){
        $_SESSION["error"]="Phone number seems invalid.";
      }
      else{
        if(($_POST["reg"]/1000000000)<0){
          $_SESSION["error"]="Registration Number seems invalid.";
        }
        else{
          $sql="SELECT sizeID FROM size WHERE Size=:s";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
            ':s'=>$_POST["size"]
          ));
          $result1=$stmt->fetch(PDO::FETCH_ASSOC);
          $sql="INSERT INTO student(name,reg,phone,sizeID) VALUES (:name,:reg,:phone,:sizeID)";
          $stmt=$pdo->prepare($sql);
          try{
            $stmt->execute(array(
              ':name'=>$_POST["name"],
              ':reg'=>$_POST["reg"],
              ':phone'=>$_POST["phone"],
              ':sizeID'=>$result1["sizeID"]
            ));
          }
          catch(PDOException $err){
            $_SESSION["error"]="Unexpected Error Encountered. Please contact the System Admin if the error persists.";
            error_log($err->getMessage());
            header('Location:tshirt.php');
            return;
          }
          if($stmt){
            $sql="SELECT studID FROM student WHERE reg=:r";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
              ':r'=>$_POST["reg"]
            ));
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            $sql="INSERT INTO tpay(studID,statusID,modeID) VALUES(:s,2,1)";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
              ':s'=>$result["studID"]
            ));
            $_SESSION["message"]="The payment is being processed. You will be notified once the order is placed.";
            header('Location:tshirt.php');
            return;
          }
          else{
            $_SESSION["error"]="Unexpected Error Encountered. Please contact the System Admin if the error persists.";
            error_log($err->getMessage());
            header('Location:tshirt.php');
            return;
          }
        }
      }
    }
  }
  if(isset($_POST["continue1"])){
    if(empty($_POST["name"])||(empty($_POST["reg"]))||empty($_POST["size"])||empty($_POST["phone"])){
        $_SESSION["error"]="Please don't leave any field empty.";
    }
    else{
      if(($_POST["phone"]/1000000000)<0){
        $_SESSION["error"]="Phone number seems invalid.";
      }
      else{
        if(($_POST["reg"]/1000000000)<0){
          $_SESSION["error"]="Registration Number seems invalid.";
        }
        else{
          $sql="SELECT sizeID FROM size WHERE Size=:s";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
            ':s'=>$_POST["size"]
          ));
          $result1=$stmt->fetch(PDO::FETCH_ASSOC);
          $sql="INSERT INTO student(name,reg,phone,sizeID) VALUES (:name,:reg,:phone,:sizeID)";
          $stmt=$pdo->prepare($sql);
          try{
            $stmt->execute(array(
              ':name'=>$_POST["name"],
              ':reg'=>$_POST["reg"],
              ':phone'=>$_POST["phone"],
              ':sizeID'=>$result1["sizeID"]
            ));
          }
          catch(PDOException $err){
            $_SESSION["error"]="Unexpected Error Encountered. Please contact the System Admin if the error persists.";
            error_log($err->getMessage());
            header('Location:tshirt.php');
            return;
          }
          if($stmt){
            $sql="SELECT studID FROM student WHERE reg=:r";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
              ':r'=>$_POST["reg"]
            ));
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            $sql="INSERT INTO tpay(studID,statusID,modeID) VALUES(:s,2,2)";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array(
              ':s'=>$result["studID"]
            ));
            $_SESSION["message"]="The payment is being processed. You will be notified once the order is placed.";
            header('Location:tshirt.php');
            return;
          }
          else{
            $_SESSION["error"]="Unexpected Error Encountered. Please contact the System Admin if the error persists.";
            error_log($err->getMessage());
            header('Location:tshirt.php');
            return;
          }
        }
      }
    }
  }

?>

<html>
  <head>
    <title>TT' 18 | Tshirt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="T-Shirt" content="JSC3D">
  </head>
  <body style="margin: 0px">
    <div style="width: 40%;
                margin: 0 20 0 0;
                position: relative;
                font-size: 9pt;
                color: #777;">
      <canvas id="cv" style="width:inherit" height="425px"></canvas>
    </div>
    <script type="text/javascript" src="jsc3d.js"></script>
    <script type="text/javascript" src="jsc3d.touch.js"></script>
    <script type="text/javascript" src="jsc3d.webgl.js"></script>
    <script type="text/javascript">
      var canvas = document.getElementById('cv');
      var viewer = new JSC3D.Viewer(canvas);
      viewer.setParameter('SceneUrl','shirt.obj');
      viewer.setParameter('InitRotationX',0);
      viewer.setParameter('InitRotationY',20);
      viewer.setParameter('InitRotationZ',0);
      viewer.setParameter('ModelColor','#000000');
      viewer.setParameter('BackgroundColor1','#FFFFFF');
      viewer.setParameter('BackgroundColor2','#000000');
      viewer.setParameter('RenderMode','textureflat');
      viewer.setParameter('Definition','high');
      viewer.setParameter('Renderer','webgl');
      viewer.setParameter('Background','off');
      viewer.setParameter('ProgressBar','on');
      viewer.init();
      viewer.update();
    </script>
    <div id="editions"></div>
    <div id="editions2"></div>
    <div class="container-right">
      <form action="tshirt.php" method="post">
        <h2>Sign up for Tech Tatva '18 Tees</h2>
        <p>
        <?php
          if(isset($_SESSION["error"])){
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
          }
          if(isset($_SESSION["message"])){
            echo $_SESSION["message"];
            unset($_SESSION["message"]);
          }
        ?>
        </p>
        <p>
          Name <br><input type="text" name="name" placeholder="Enter your name here." required="required"><br>
          Reg no. <br><input type="number" pattern="/^\d+${10}/" placeholder="Registration Number" name="reg" required="required"><br>
          Phone no. <br><input type="number" pattern="/^\d+${10}/" placeholder="Phone number" name="phone" required="required"><br>
          Size<br>
          <div class="select-custom" style="display:inline; width:50%; position:relative; border-radius:20px">
          <select name="size" required="required">
              <option hidden selected>Set your size</option>
              <option>S</option>
              <option>M</option>
              <option>L</option>
              <option>XL</option>
              <option>XXL</option>
            </select>
          </div><br>
          <input class="button" type="submit" value="Pay Online" name="continue">
          <input class="button" type="submit" value="Pay Offline" name="continue2">
        </p>
        <a href="https://www.facebook.com/MITtechtatva/" class="fa fa-facebook"></a><a class="fb" href="https://www.facebook.com/MITtechtatva/">@MITtechtatva</a><br>
        <a href="https://www.instagram.com/mittechtatva/" class="fa fa-instagram"></a><a class="insta" href="https://www.instagram.com/mittechtatva/">@mittechtatva</a>
      </form>
    </div>
  </body>
</html>
