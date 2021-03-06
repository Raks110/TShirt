<?php
  require_once('pdo.php');
  if(isset($_POST["continue2"])){
    if(empty($_POST["name"])||(empty($_POST["reg"]))||empty($_POST["size"])||empty($_POST["phone"])){
        header('Location:tshirt.php?err=1');
        return;
    }
    else{
      if(!isset($_POST["phone"])){
        header('Location:tshirt.php?err=2');
        return;
      }
      else{
        if(!isset($_POST["reg"])){
          header('Location:tshirt.php?err=3');
          return;
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
            error_log($err->getMessage());
            header('Location:tshirt.php?err=4');
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
            header('Location:tshirt.php?err=5');
            return;
          }
          else{
            error_log($err->getMessage());
            header('Location:tshirt.php?err=6');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script>
      $(document).ready(function(){
       $("a").on('click', function(event) {
         if (this.hash !== "") {
           event.preventDefault();
           var hash = this.hash;
           $('html, body').animate({
             scrollTop: $(hash).offset().top
           }, 800, function(){
             window.location.hash = hash;
           });
         }
       });
      });
    </script>
  </head>
  <body style="margin: 0px">
    <nav>
      <table>
      <tr><td><a href="#cv">View the Tee</a></td>
      <td><a href="#form">Sign-up Form</a></td></tr>
      </table>
    </nav>
    <span class="heading1">Tech Tatva 2018 is here</span>
    <p><div id="error1">

      <?php

      if(isset($_GET['err'])){
        switch($_GET['err']){
          case 1:
            echo "Please don't leave any field empty.";
            break;
          case 2:
            echo "Phone number seems invalid.";
            break;
          case 3:
            echo "Registration Number seems invalid.";
            break;
          case 4:
            echo "Unexpected Error occured. Please contact your System Admin if the error persists.";
            break;
          case 5:
            echo "The Payment is being processed. Please make your payment at the Infodesk to successfully place your order.";
            break;
          case 6:
            echo "Unexpected Error Encountered. Please contact the System Admin if the error persists.";
            break;
        }}
      ?>

    </div></p>
    <div class="cvdiv">
      <canvas id="cv" class="cvcv" style="width:inherit" height="450px"></canvas>
    </div>
    <script type="text/javascript" src="jsc3d.js"></script>
    <script type="text/javascript" src="jsc3d.touch.js"></script>
    <script type="text/javascript" src="jsc3d.webgl.js"></script>
    <script type="text/javascript">
      var canvas = document.getElementById('cv');
      var viewer = new JSC3D.Viewer(canvas);
      viewer.setParameter('SceneUrl','shirt.obj');
      viewer.setParameter('InitRotationX',0);
      viewer.setParameter('InitRotationY',22);
      viewer.setParameter('InitRotationZ',0);
      viewer.setParameter('ModelColor','#000000');
      viewer.setParameter('BackgroundColor1','#9398ff');
      viewer.setParameter('BackgroundColor2','#9398ff');
      viewer.setParameter('Background','off');
      viewer.setParameter('RenderMode','textureflat');
      viewer.setParameter('MipMapping','on');
      viewer.setParameter('Definition','high');
      viewer.setParameter('Renderer','webgl');
      viewer.init();
      viewer.update();
    </script>
    <div id="editions"></div>
    <div id="editions2"></div>
    <div class="container-right">
      <form action="tshirt.php" method="post" id="form">
        <span class="heading">Sign up for Tech Tatva '18 Tees</span><br>
        <div id="error2">

          <?php

          if(isset($_GET['err'])){
            switch($_GET['err']){
              case 1:
                echo "Please don't leave any field empty.";
                break;
              case 2:
                echo "Phone number seems invalid.";
                break;
              case 3:
                echo "Registration Number seems invalid.";
                break;
              case 4:
                echo "Unexpected Error occured. Please contact your System Admin if the error persists.";
                break;
              case 5:
                echo "The Payment is being processed. Please make your payment at the Infodesk to successfully place your order.";
                break;
              case 6:
                echo "Unexpected Error Encountered. Please contact the System Admin if the error persists.";
                break;
            }}
          ?>

        </div>
        <p>
          Name <br><input type="text" name="name" placeholder="Enter your name here." required="required"><br>
          Reg no. <br><input type="number" pattern="/^\d+${10}/" placeholder="Registration Number" name="reg" required="required"><br>
          Phone no. <br><input type="number" pattern="/^\d+${10}/" placeholder="Phone number" name="phone" required="required"><br>
          Size<br>
          <select name="size" required="required">
              <option hidden selected>Set your size</option>
              <option>S</option>
              <option>M</option>
              <option>L</option>
              <option>XL</option>
              <option>XXL</option>
            </select>
          <br>
          <input class="button" type="submit" value="Pay Offline" name="continue2">
        </p>
        <a href="https://www.facebook.com/MITtechtatva/" class="fa fa-facebook"></a><a class="fb" href="https://www.facebook.com/MITtechtatva/">@MITtechtatva</a><br>
        <a href="https://www.instagram.com/mittechtatva/" class="fa fa-instagram"></a><a class="insta" href="https://www.instagram.com/mittechtatva/">@mittechtatva</a>
      </form>
    </div>
  </body>
</html>
