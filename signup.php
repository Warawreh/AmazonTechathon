<?php
  require 'header.php';
?>
<link rel="stylesheet" href="css/signup.css">

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NAME ME PLZ</title>
</head>
<body>
  <form method="post" action="includes/signup.inc.php">
  	<div id = "signf">
  		<h1>انشاء حساب جديد</h1>
  		<div id = "infot">
  			<div class="dcon">
          <div id="error">
            <?php
            if(isset($_GET['error'])){
              $er = $_GET['error'];
              if($er == "badname"){
                echo "اسم المستخدم خاطئ";
              }else if($er == "pwdnotmatch"){
                echo "كلمة المرور واعادة كلمة المرور غير متشابهة";
              }else if($er == "emptyfield"){
                echo "يجب تعبئة جميع البينات";
              }else if($er == "nouni"){
                echo "يجب اختيار جامعة";
              }else if($er == "nomajor"){
                echo "يجب اختيار تخصص";
              }else if($er == "nomajornouni"){
                echo "يجب اختيار الجامعة والتخصص";
              }else if($er == "pwdinname"){
                echo "لا يجب ان يكون كلمة السر جزء من الاسم";
              }else if($er == "userexist"){
                echo "الاسم مستخدم";
              }else if($er == "emailexist"){
                echo "البريد الالكتروني مستخدم";
              }
            }
            ?>
          </div>
  				<div>الأسم </div>
  				<input placeholder="الاسم" type="text" name="uname">
          <span>يجب ان يتكون الاسم من احرف انجليزية او ارقام وطول الاسم اكبر من 6 احرف واقل من 24 حرف</span>
  			</div>
  			<div class="dcon">
  				<div>البريد الإلكتروني</div>
  				<input placeholder="البريد الالكتروني" type="email" name="uemail">
  			</div>
  			<div class="dcon">
  				<div>كلمة السر</div>
  				<input placeholder="كلمة السر" type="password" name="pwd">
  			</div>
  			<div class="dcon">
  				<div>إعادة ادخال كلمة السر</div>
  				<input placeholder="اعدة كلمة السر" type="password" name="repwd">
  			</div>
  			<div class="dcon">
          <div class="inlinedata2">اختر جامعتك</div>
  				<select name="uuni" class="inlinedata1">
        				<option>--University--</option>
        				<option>Jordan University</option>
      			</select>
  			</div>
  			<div class="dcon">
          <div class="inlinedata2">اختر تخصصك</div>
      			<select name="umajor" class="inlinedata1">
        				<option>--Major--</option>
        				<option>Computer Engineering</option>
      			</select>
  			</div>
  			<div class="dcon" style="text-align: center;">
  				<button type="submit" name="signup-submit" style="font-family: 'Tajawal', sans-serif;">أنشاء حساب جديد</button>
  			</div>
  		</div>
  	</div>
  </form>
</body>
</html>

<?php
require 'footer.html';
?>
