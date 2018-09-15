<?php

  require_once('pdo.php');
  if(isset($_POST['cancel'])){
    unset($_POST["submit"]);
    header('Location:organizers.php');
  }

  ?>

  <html>
  <head>
    <title>Tees Organizer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      input[type="text"]:hover,input[type="text"]:focus{
        background-color: #cccccc;
        transition: 0.8s;
      }
    </style>
  </head>
  <body style="padding:20px;">
    <form method="post" action="organizers.php" class="form-inline">
      <?php
      if(!isset($_POST["submit"])){
        echo "<input type='text' name='search' placeholder='Search Here' class='form-control' style='margin-right:10px'>";
        echo '<input type="submit" value="Search" name="submit" class="btn btn-primary">';
      }
      else{
        echo "<input type='submit' value='View All Orders' name='cancel' class='btn btn-primary'>";
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
          echo "<table class='table table-hover'><tr><th>Payment ID</th><th>Student Name</th><th>Registration No.</th><th>Phone no.</th><th>Size</th></tr>";
          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td>".$row['payID']."</td><td>";
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
          echo "<table class='table table-hover'><tr><th>Payment ID</th><th>Student Name</th><th>Registration No.</th><th>Phone no.</th><th>Size</th></tr>";
          while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td>".$row['payID']."</td><td>";
            echo $row['name']."</td><td>";
            echo $row['reg']."</td><td>";
            echo $row['phone']."</td><td>";
            echo $row['Size']."</td></tr>";
          }
          echo "</table>";
        }
      }

     ?>
