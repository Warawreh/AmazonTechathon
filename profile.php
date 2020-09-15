  <?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', '1');

  require 'header.php';
  require 'includes/dbo.inc.php';

  if(!isset($_GET['user']) || $_GET['user'] == ""){
    if(!isset($_COOKIE['uname']) || $_COOKIE['uname'] == ""){
      header("Location: login.php?error=notloged");
    }else{
      header("Location: index.php?error=notexist");
    }
    exit();
  }


  {//Get student finished courses
    $done[] = array();
    $uname = $_GET['user'];
    $sql = "SELECT * FROM userinfo WHERE uname = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: index.php?error=notexist");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"s",$uname);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $student_course = $row['courses'];
      }else{
        header("Location: index.php?error=notexist");
        exit();
      }
    }
  }

  {//find finished hours and courses
    $finished = 0;
    $arr = explode ("|", $row['courses']);

    $sql = "SELECT * FROM course";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: index.php?error=notexist");
      exit();
    }else{
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      $course_hour = [];
      while ($rows = mysqli_fetch_assoc($result)) {
        // print_r($rows);
        $course_hour[$rows['id']] = $rows['hours'];
      }

      $have = count($arr) ;
      for($i=0;$i<$have;$i= $i+1){
        $arr2 = explode (",", $arr[$i]);

        if(!isset($course_hour[$arr2[0]]))continue;
        $finished += $course_hour[$arr2[0]];
        $done[$arr2[0]] = true;
      }
    }

    $major_hourse = 0;
    {//get major hourse
      $sql = "SELECT * FROM major where name = ?";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: index.php?error=notexist");
        exit();
      }else{
        mysqli_stmt_bind_param($stmt,"s",$row['umajor']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($rows = mysqli_fetch_assoc($result)) {
          // print_r($rows);
          $major_hourse = $rows['hours'];
        }
      }
    }

  }

 ?>
 <link rel="stylesheet" href="css/profile.css">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css"        type="text/css">
</head>
<body>
  <div id="profile">
    <div id="uinfo">
      <div id="uimge">
        <img src="img/user_img.png" width="auto" height="100%" alt="">
      </div>
      <div id="udata">
        <div id="dataname"><span><?php echo $row['uname']; ?> </span><span>: الطالب</span></div>
        <div id="datauniv"><span><?php echo $row['uuniversity']; ?> </span><span>: الجامعة</span></div>
        <div id="dataprof"><span><?php echo $row['umajor']; ?> </span><span>: النخصص</span></div>
        <div id="datahour"><span><?php echo $finished; ?> </span><span>: الساعات المنجزة</span></div>
      </div>
      <div id="void" >
        <div id="datahour">
          <span><?php echo $major_hourse - $finished; ?> : الساعات المتبقية</span>
        </div>
      </div>
    </div>

    <?php
      if($uname == $_COOKIE['uname']){
        echo '
        <div style="text-align:center;">
          <h1>
            اختر موادك
          </h1>
          <span>
            قم باختيار المواد التي قمت باجتيازها ليظهر لديك المواد المتاحة لهذا الفصل
          </span>
          </br></br>
          <input oninput="serach_course(this.value)" type="text" name="" value="" placeholder="ابحث بكتابة اسم او رقم المادة" style="text-align:right;width:60%;font-size:20px;direction : rtl;font-family: \'Tajawal\', sans-serif;">
        </div>
        ';
        echo '
        <div id ="ccon">

        </div>

        ';
      }
     ?>
  </div>
</body>
<script type="text/javascript">

  window.onload = function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // alert(document.getElementById("ccon").innerHTML);
        document.getElementById("ccon").innerHTML = this.responseText;
      }
    }
    var link = "includes/get_courses.php?user=" + "<?php echo $user_name; ?>";
    xmlhttp.open("GET", link, true);
    xmlhttp.send();

  }


  function removecourse(){
    //arguments
    if (confirm("هل ترغب في ازالة هذه المادة من قائمة المواد المنجزة")) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // alert(document.getElementById("ccon").innerHTML);
          document.getElementById("ccon").innerHTML = this.responseText;
        }
      }
      var link = "includes/get_courses.php?user=" + "<?php echo $user_name; ?>" + "&remove=" + arguments[0];
      xmlhttp.open("GET", link, true);
      xmlhttp.send();
    }
  }

  function addcourse(){
    //arguments

    if (confirm("هل قمت باجتياز هذه المادة ؟")) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // alert(document.getElementById("ccon").innerHTML);
          document.getElementById("ccon").innerHTML = this.responseText;
        }
      }
      var link = "includes/get_courses.php?user=" + "<?php echo $user_name; ?>" + "&add=" + arguments[0];
      xmlhttp.open("GET", link, true);
      xmlhttp.send();

    }

  }

  function serach_course(value){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // alert(document.getElementById("ccon").innerHTML);
        document.getElementById("ccon").innerHTML = this.responseText;
      }
    }
    var link = "includes/get_courses.php?user=" + "<?php echo $user_name; ?>" + "&search=" + value;
    // alert(link);
    xmlhttp.open("GET", link, true);
    xmlhttp.send();
  }

</script>
<?php
require 'footer.html';
?>
</html>
