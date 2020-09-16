<!-- Calling the header -->
<?php
  require 'header.php';
?>
<link rel="stylesheet" href="css/login.css"        type="text/css">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div id = "signf">
		<h1>تسجيل الدخول</h1>

    <form method="post" action="includes/login.inc.php">
  		<div id = "infot">
  			<div class="dcon">
          <div id="error">
            <!-- The cases of sign in errors -->
            <?php
            if(isset($_GET['error'])){
              $er = $_GET['error'];
              if($er == "badname"){
                echo "اسم المستخدم غير موجود";
              }else if($er == "wrongpass"){
                echo "كلمة المرور غير صحيحة";
              }else if($er == "emptyfield"){
                echo "يجب تعبئة جميع البينات";
              }
            }
            ?>
          </div>
  				<div>الاسم</div>
  				<input placeholder="اسم / بريد الكتروني" type="text" name="uname">
			</div>
  			<div class="dcon">
  				<div>كلمة السر</div>
  				<input placeholder="كلمة المرور" type="password" name="pwd">
  				<div style="margin-top: 5px;"><a href="#" class="forget">نسيت كلمة السر ؟</a></div>
  			</div>
  			<div class="dcon" style="text-align: center;">
  				<button name="login-submit" style="font-family: 'Tajawal', sans-serif;">تسجيل</button>
          <a href = "signup.php" style="color:white;margin-right:3%">انشاء حساب جديد</a>
  			</div>
      </form>
		</div>
	</div>
</body>
<!-- Calling the footer -->
<?php
require 'footer.html';
?>
