<?php
//Check if he got here in a legit way
if(isset($_POST['course-submit'])){
  require 'dbo.inc.php';//open db

  //Get course data
  $cid = $_POST['cid'];//id
  $cname = $_POST['cname'];//name
  $cuni = $_POST['cuni'];//university
  $chour = $_POST['chour'];//hourse
  if(!isset($cid) || !isset($cname) || !isset($chour) || $cuni == "--University--"){
    //all fields must not be empty
    header("Location: ../adminpanal.php?error=emptyfield");
    exit();
  }else{
    //check if name or id is already used
    //use place holder to avoid getting hacked
    $sql = "SELECT * FROM course WHERE name = ? OR id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      //db error send back
      header("Location: ../adminpanal.php?error=sqlerror");
      exit();
    }else{
      //bind data
      mysqli_stmt_bind_param($stmt,"si",$cname,$cid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        //if name or id is used then send back
        header("Location: ../adminpanal.php?error=exist");
        exit();
      }else{
        //if name and id is not used then inser all the data
        //use place holder to avoid getting hacked
        $sql = "INSERT INTO course (id,name,university,hours) VALUES (? , ? , ? , ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          //db error send back
          header("Location: ../adminpanal.php?error=sqlerror");
          exit();
        }else{
          //bind data then excute the insertion
          mysqli_stmt_bind_param($stmt,"ssss",$cid,$cname,$cuni,$chour);
          mysqli_stmt_execute($stmt);
          header("Location: ../adminpanal.php?error=success");
          exit();
        }
      }
    }
  }

  //close the db
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}else{
  //if hacker send him back
  header("Location: ../index.php");
  exit();
}
 ?>
