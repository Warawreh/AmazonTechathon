<?php
//Check if request came in a legal way
if(isset($_POST['login-submit'])){

  //open db
  require 'dbo.inc.php';

  //get username and password which is used on login
  $uname = $_POST['uname'];
  $pwd = $_POST['pwd'];

  //Validation checks
  if(empty($uname) || empty($pwd)){
    //Files must not be empty
    header("Location: ../login.php?error=emptyfield");
    exit();
  }else if(!preg_match("/^[a-zA-Z0-9]*$/", $uname) || strlen($uname) > 24 || strlen($uname) < 6){
    //User name is in englith and have length in range [6,24]
    header("Location: ../login.php?error=badname");
    exit();
  }else{

    //Check if the username is valid (as username or as email)
    $sql = "SELECT * FROM userinfo WHERE uname = ? OR uemail = ?;";//use holder to avoid hacking
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      //on error at the db redirect
      header("Location: ../login.php?error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"ss",$uname,$uname);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      //check if user name occuers in the database
      if($row = mysqli_fetch_assoc($result)){
        //check if the password match
        //we need to decrypt the password bacuse is encrypted in the db to avoid account from getting hacked easliy
        $check = password_verify($pwd,$row['pwd']);
        if($check == false){
          //if password dosn not match redirect
          header("Location: ../login.php?error=wrongpass");
          exit();
        }else{
          //if password match save name in cookies
          $cookie_name = "uname";
          $cookie_value = $row['uname'];
          setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // save login for 1 year (86400 = 1 day)
          //redirect user with success state
          header("Location: ../index.php?error=success");
        }
      }else{
        //on error at the db redirect
        header("Location: ../login.php?error=sql");
        exit();
      }
    }
  }
  //Close the db
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}else{
  //page accessed in non-legal way and we must send him away to index page
  header("Location: ../index.php?error=hacker");
  exit();
}
 ?>
