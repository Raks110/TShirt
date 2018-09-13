<?php

  session_start();
  require_once('pdo.php');
  if((!isset($_SESSION["infoID"]))||(!isset($_SESSION["sysID"]))){
    die("Unauthorized Access. Please Login to continue.");
  }

 ?>
 <html>
  <head>
    <title>TT'18 | Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body style="padding:20px">
      <div style="position:sticky;top:0;background:rgba(255,255,255,0.8);margin-bottom:10px;">
        <a href="logout.php">Logout</a>
      </div>
      <?php

        if(isset($_SESSION["message"])){
          echo "<div style='padding:10 0 30 0'><font color='green'>";
          echo $_SESSION["message"];
          unset($_SESSION["message"]);
          echo "</font></div>";
        }

      ?>
      <table class="table table-hover" border="0" width="75%">
      <?php
        $sql="SELECT COUNT(*) FROM tpay WHERE statusID=2 AND modeID=1";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        if($result["COUNT(*)"]>0){
          echo "<p>Review and confirm the following online payments.</p>";
          echo "<thead><tr><td>Name</td><td>Registration No.</td><td>Payment Time</td><td>Payment ID</td><td>Action</td></tr></thead>";
          $sql="SELECT student.studID,student.name,student.reg,tpay.signtime,tpay.payID FROM tpay JOIN student WHERE tpay.statusID=2 AND tpay.modeID=1 AND student.studID = tpay.studID";
          $stmt=$pdo->prepare($sql);
          $stmt->execute();
          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td><span>".$row['name']."</span></td>";
            echo "<td><span>".$row['reg']."</span></td>";
            echo "<td><span>".$row['signtime']."</span></td>";
            echo "<td><span>".$row['payID']."</span></td>";
            echo "<td><form method='get' action='confirm.php'><input type='hidden' name='studID' value='".$row['studID']."'><input class='btn btn-primary' type='submit' name='submit' value='Confirm Payment'></form></td></tr>";
          }
        }
        else{
          echo "<p>No pending online payers as of now.</p>";
        }
       ?>
     </table>
     <table class="table table-hover" border="0" width="75%">
       <?php
         $sql="SELECT COUNT(*) FROM tpay WHERE statusID=2 AND modeID=2";
         $stmt=$pdo->prepare($sql);
         $stmt->execute();
         $result=$stmt->fetch(PDO::FETCH_ASSOC);
         if($result["COUNT(*)"]>0){
           echo "<p>Offline Payments to be confirmed.</p>";
           echo "<thead><tr><td>Name</td><td>Registration No.</td><td>Payment Time</td><td>Payment ID</td><td>Action</td></tr></thead>";
           $sql="SELECT student.studID,student.name,student.reg,tpay.signtime,tpay.payID FROM tpay JOIN student WHERE tpay.statusID=2 AND tpay.modeID=2 AND student.studID = tpay.studID";
           $stmt=$pdo->prepare($sql);
           $stmt->execute();
           while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
             echo "<tr><td>".$row['name']."</td>";
             echo "<td>".$row['reg']."</td>";
             echo "<td>".$row['signtime']."</td>";
             echo "<td>".$row['payID']."</td>";
             echo "<td><form method='post' action='confirm.php'><input type='hidden' name='payID' value='".$row['payID']."'><input type='hidden' name='studID' value='".$row['studID']."'><input class='btn btn-primary' type='submit' name='submit' value='Confirm Payment'></form></td></tr>";
           }
         }
         else{
           echo "<p>No pending offline payers as of now.</p>";
         }
        ?>
      </table>
   </body>
  </html>
