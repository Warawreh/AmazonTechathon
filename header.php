<?php

  //Check if the current user is logged in the website
  //by getting the saved cookies
  $logged = false;
  $user_name = "";
  if(isset($_COOKIE['uname']) && $_COOKIE['uname'] != ""){
    $user_name = $_COOKIE['uname'];//save the user name
    $logged = true;
    // echo '<script type="text/javascript"> alert('.$user_name.') </script>';
  }

 ?>

<head>
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<link rel="icon" href="img/web_icon.jpg">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/header.css" type="text/css">
</head>
<header>
	<div id = "header">
		<div id = "logo">
        <a href="index.php">
          <img src="img/icon.png" width="60px" height="60px" alt="">
        </a>
        <a href="index.php">
          <span>
            University <br> Student Assistant
          </span>
        </a>
    </div>
    <div id="menu">
      
      <a href="#"><div class="menubtn">تسجيل</div></a>
      <a href="#"><div class="menubtn">الرئيسية</div></a>
      <a href="#"><div class="menubtn">نقاش</div></a>
      <a href="#"><div class="menubtn">مواد مقترحة</div></a>

      <div id = "ddmenu">
        <button onclick="toggle()" id = "ddbtn">☰</button>
        <div id="dropdown-content">
          <div id = "uinfo">
            <?php
            //For small screen
              if($logged){
                //if user is logged display profile and logout button
                ?>
                <a href="profile.php?user=<?php echo $user_name; ?>"><?php echo $user_name; ?></a>
                <a href="includes/logout.inc.php">خروج</a>
                <?php
              }else{
                //if user is not looged display login and signup button
                ?>
                <a href="signup.php">انشاء حساب</a>
                <a href="login.php">تسجيل دخول</a>
                <?php
              }
           ?>
          </div>
          <a href="#">الرئيسية</a>
          <a href="#">نقاش</a>
          <a href="#">مواد مقترحة</a>
        </div>
      </div>
    </div>
</header>
<script>
  var current = false;
  function toggle(){
    if(current == false){
      document.getElementById("dropdown-content").style.display = "block";
    }else{
      document.getElementById("dropdown-content").style.display = "none";
    }
    current = !current;
  }
</script>