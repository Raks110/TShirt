<?php

  require_once('pdo.php');
  if(isset($_POST['cancel'])){
    unset($_POST["submit"]);
  }

  ?>

  <html>
  <head><title>Tees Organizer</title></head>
  <body>
    <form method="post" action="organizers.php">
      <?php
      if(!isset($_POST["submit"])){
        echo "<input type='text' name='search' placeholder='Search Here'>";
        echo '<input type="submit" value="Search" name="submit">';
      }
      else{
        echo "<input type='submit' value='Cancel Search' name='cancel'>";
      }
      ?>
    </form>
    <?php
      if(!isset($_POST["submit"])){
        $sql="SELECT COUNT(*) FROM tpay";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        if($result["COUNT(*)"]==0){
          echo "There are no orders as of now. Check back later.";
        }
        else{
          $sql="SELECT tpay.payID,student.name,student.reg,student.phone,size.Size FROM tpay JOIN student JOIN size WHERE tpay.studID=student.studID AND size.sizeID=student.sizeID";
          $stmt=$pdo->prepare($sql);
          $stmt->execute();
          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<table><tr><th>Payment ID</th><th>Student Name</th><th>Registration No.</th><th>Phone no.</th><th>Size</th></tr><tr><td>";
            echo $row['payID']."</td><td>";
            echo $row['name']."</td><td>";
            echo $row['reg']."</td><td>";
            echo $row['phone']."</td><td>";
            echo $row['Size']."</td></tr>";
          }
          echo "</table>";
        }
      }
      else{
        $sql="SELECT COUNT(*) FROM tpay JOIN student JOIN size WHERE (size.sizeID=student.sizeID AND student.studID = tpay.studID) AND (phone LIKE :p OR reg LIKE :r OR name LIKE :n OR payID LIKE :pid OR Size LIKE :s)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
          ':p'=>'%'.$_POST["search"].'%',
          ':r'=>'%'.$_POST["search"].'%',
          ':n'=>'%'.$_POST["search"].'%',
          ':pid'=>'%'.$_POST["search"].'%',
          ':s'=>'%'.$_POST["search"].'%'
        ));
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        if($result["COUNT(*)"]==0){
          echo "There are no orders that match your search as of now. Check back later.";
        }
        else{
          $sql="SELECT tpay.payID,student.name,student.reg,student.phone,size.Size FROM tpay JOIN student JOIN size WHERE (tpay.studID=student.studID AND size.sizeID=student.sizeID) AND (phone LIKE :p OR reg LIKE :r OR name LIKE :n OR payID LIKE :pid OR Size LIKE :s)";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
            ':p'=>'%'.$_POST["search"].'%',
            ':r'=>'%'.$_POST["search"].'%',
            ':n'=>'%'.$_POST["search"].'%',
            ':pid'=>'%'.$_POST["search"].'%',
            ':s'=>'%'.$_POST["search"].'%'
          ));
          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<table><tr><th>Payment ID</th><th>Student Name</th><th>Registration No.</th><th>Phone no.</th><th>Size</th></tr><tr><td>";
            echo $row['payID']."</td><td>";
            echo $row['name']."</td><td>";
            echo $row['reg']."</td><td>";
            echo $row['phone']."</td><td>";
            echo $row['Size']."</td></tr>";
          }
          echo "</table>";
        }
      }

     ?>
