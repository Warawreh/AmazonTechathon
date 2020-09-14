<?php
//Check if he got here in a legit way
if(isset($_POST['major-submit'])){
  require 'dbo.inc.php';//open db

  //Get major data
  $mname = $_POST['mname'];//name
  $muni = $_POST['muni'];//university
  $mhour = $_POST['mhour'];//hours
  $mfac = $_POST['mfac'];//facility
  $mcourse = $_POST['mcourse'];//courses

  //data checking
  if(!isset($mname) || !isset($mhour) || !isset($mcourse) || $muni == "--University--" || $mfac == "--Facility--"){
    //no filed must be empty
    header("Location: ../adminpanal.php?error=emptyfield");
    exit();
  }else{
    //check if major name already exist
    $sql = "SELECT * FROM major WHERE name = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      //on db error redirect
      header("Location: ../adminpanal.php?error=sqlerror");
      exit();
    }else{
      //bind and excuted commands
      mysqli_stmt_bind_param($stmt,"s",$mname);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        //if name already exist send back
        header("Location: ../adminpanal.php?error=exist");
        exit();
      }else{
        //if not already exist then insert the data
        $sql = "INSERT INTO major (name,university,hours,fac,course) VALUES (? , ? , ? , ? , ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../adminpanal.php?error=sqlerror");
          exit();
        }else{
          //bind and excute then redirect with success message
          mysqli_stmt_bind_param($stmt,"sssss",$mname,$muni,$mhour,$mfac,$mcourse);
          mysqli_stmt_execute($stmt);
          header("Location: ../adminpanal.php?error=success");
          exit();
        }
      }
    }
  }


  //close db
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}else{
  //redirect if hacker
  header("Location: ../index.php");
  exit();
}
 ?>
