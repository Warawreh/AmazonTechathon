<?php
//Check if request came in a legal way
if(isset($_POST['signup-submit'])){
  //open db
  require 'dbo.inc.php';

  //get userdata
  $uname = $_POST['uname'];//name
  $uemail = $_POST['uemail'];//email
  $pwd = $_POST['pwd'];//password
  $repwd = $_POST['repwd'];//re-password
  $uuni = $_POST['uuni'];//univeristy
  $umajor = $_POST['umajor'];//major

  //Validation checks

  if(!isset($uname) || !isset($uemail) || !isset($pwd) || !isset($repwd)){
    //Files must not be empty
    header("Location: ../signup.php?error=emptyfield&uname=".$uname."&uemail=".$uemail);
    exit();
  }else if(!preg_match("/^[a-zA-Z0-9]*$/", $uname) || strlen($uname) > 24 || strlen($uname) < 6){
    //username must be between 6,24 chars and uses only a-z or A-Z or 1-9
    header("Location: ../signup.php?error=badname&uemail=".$uemail);
    exit();
  }else if($pwd != $repwd){
    //password and re-password must match
    header("Location: ../signup.php?error=pwdnotmatch&uname=".$uname."&uemail=".$uemail);
    exit();
  }else if($umajor == "--Major--" && $uuni == "--University--"){
    //must have univeristy and major
    header("Location: ../signup.php?error=nomajornouni&uname=".$uname."&uemail=".$uemail);
    exit();
  }else if($umajor == "--Major--"){
    //must have major
    header("Location: ../signup.php?error=nomajor&uname=".$uname."&uemail=".$uemail);
    exit();
  }else if($uuni == "--University--"){
    //must have univeristy
    header("Location: ../signup.php?error=nouni&uname=".$uname."&uemail=".$uemail);
    exit();
  }else{
    if(strlen($pwd) <= strlen($uname)){
      //password must not be part of the user-name

      for($i=0;$i + strlen($pwd) <= strlen($uname);$i = $i + 1){
        if($pwd == substr($uname , $i,strlen($pwd))){
          header("Location: ../signup.php?error=pwdinname&uname=".$uname."&uemail=".$uemail);
          exit();
        }
      }

    }

    //insert data to the db
    $sql = "SELECT uname FROM userinfo WHERE uname=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"s",$uname);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $result = mysqli_stmt_num_rows($stmt);
      if($result != 0){
        //if name exist send back
        header("Location: ../signup.php?error=userexist&uname=".$uname."&uemail=".$uemail);
        exit();
      }else{

        $sql = "SELECT uemail FROM userinfo WHERE uemail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          //on error on db go back
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }else{
          mysqli_stmt_bind_param($stmt,"s",$uemail);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $result = mysqli_stmt_num_rows($stmt);
          if($result != 0){
            //if email exist send back
            header("Location: ../signup.php?error=emailexist&uname=".$uname."&uemail=".$uemail);
            exit();
          }else{
            $sql = "INSERT INTO userinfo (uname,uemail,pwd,uuniversity,umajor) VALUES (? , ? , ? , ? , ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
              //on error on db go back
              header("Location: ../signup.php?error=sqlerror");
              exit();
            }else{
              //bind data and insert to db
              $hashed_pwd = password_hash($pwd,PASSWORD_DEFAULT);

              mysqli_stmt_bind_param($stmt,"sssss",$uname,$uemail,$hashed_pwd,$uuni,$umajor);
              mysqli_stmt_execute($stmt);
              header("Location: ../login.php?error=success");
              exit();
            }
          }
        }
      }
    }
  }

  //close db
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}else{
  header("Location: ../signup.php?error=hacker");
  exit();
}
?>
