<?php
  require 'header.php';
  require 'includes/dbo.inc.php';

  $direct_score = 2;
  $undirect_score = 1;
  $level_score = -0.2;
  $rate_score = 1;

  if(!isset($_POST['calc_course'])){
    // header("Location: index.php?error=badlink");
    // exit();
  }
  $name = $user_name;
  $out = [];
  $score = [];

  $sql = "SELECT * FROM userinfo WHERE uname = ?";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: login.php?error=sql");
    exit();
  }else{
    mysqli_stmt_bind_param($stmt,"s",$name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)){

    }else{
      header("Location: login.php?error=notloged");
      exit();
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
        if(!isset($course_hour[$arr2[0]])){
          continue;
        }
        // echo $arr2[0].' '.$course_hour[$arr2[0]]."</br>";
        $finished += $course_hour[$arr2[0]];
        $done[$arr2[0]] = true;
      }
    }
  }
  $queue = [];
  $len = 0;
  $sz = [];
  $dad = [];
  $good = [];
  $items = "";

  {//Major Subjects
    $sql = "SELECT * FROM major WHERE name = ? AND university = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: index.php?error=notexisst");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"ss",$row['umajor'],$row['uuniversity']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($minfo = mysqli_fetch_assoc($result)){
        $arr = explode ("|", $minfo['course']);
        $have = count($arr);
        $orderc = array();
        for($i=0;$i<$have;$i= $i+1){
          $arr2 = explode (",", $arr[$i]);
          if($items != "")$items .= '|';
          $items .= $arr2[0];
          // echo $arr2[0].' '.$arr[$i]."</br>";
          $dad += array($arr2[0] => $arr[$i]);
          if(isset($done[$arr2[0]]) && $done[$arr2[0]] == true){
            //Finised
          }else{
            //Red or blue
            $need = count($arr2) - 1;
            for($j = 1;$j<count($arr2);$j=$j+1){
              if(isset($out[$arr2[$j]])){
                $out[$arr2[$j]]++;
              }else{
                $out[$arr2[$j]] = 1;
              }
              if(isset($score[$arr2[$j]])){
                $score[$arr2[$j]]+= $direct_score;
              }else{
                $score[$arr2[$j]] = $direct_score;
              }
              if(isset($done[$arr2[$j]]) && $done[$arr2[$j]] == 1){
                $need--;
              }
            }

            if($need == 1 && substr($arr2[1],strlen($arr2[1]) - 1,1) == "H"){
              if($finished >= substr($arr2[1],0,2)){
                $need = 0;
              }
            }

            if($need == 0){
              //Not finished but avilable
              $good[$arr2[0]] = true;
              if($items != "")$items .= '|';
              $items .= $arr2[0];
            }else{
              //Not finished and not avilable
            }
          }
        }
      }else{
        // header("Location: index.php?error=notexist");
        exit();
      }
    }
  }

  {//Major Optional
    $sql = "SELECT * FROM major WHERE name = ? AND university = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: index.php?error=notexisst");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"ss",$row['umajor'],$row['uuniversity']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($minfo = mysqli_fetch_assoc($result)){
        $arr = explode ("|", $minfo['ocourse']);
        $needed_houers = $arr[0];
        $have = count($arr);
        $orderc = array();
        for($i=1;$i<$have;$i= $i+1){
          $arr2 = explode (",", $arr[$i]);
          if(isset($done[$arr2[0]]) && $done[$arr2[0]] == true){
            //Finised
            $needed_houers -= 3;
          }
        }

        for($i=1;$i<$have;$i= $i+1){
          $arr2 = explode (",", $arr[$i]);
          if($items != "")$items .= '|';
          $items .= $arr2[0];
          // echo $arr2[0].' '.$arr[$i]."</br>";
          $dad += array($arr2[0] => $arr[$i]);
          if(isset($done[$arr2[0]]) && $done[$arr2[0]] == true){
            //Finised
          }else if($needed_houers != 0){
            //Red or blue
            $need = count($arr2) - 1;
            for($j = 1;$j<count($arr2);$j=$j+1){
              if(isset($out[$arr2[$j]])){
                $out[$arr2[$j]]++;
              }else{
                $out[$arr2[$j]] = 1;
              }
              if(isset($score[$arr2[$j]])){
                $score[$arr2[$j]] += $direct_score;
              }else{
                $score[$arr2[$j]] = $direct_score;
              }
              if(isset($done[$arr2[$j]]) && $done[$arr2[$j]] == 1){
                $need--;
              }
            }

            if($need == 1 && substr($arr2[1],strlen($arr2[1]) - 1,1) == "H"){
              if($finished >= substr($arr2[1],0,2)){
                $need = 0;
              }
            }

            if($need == 0){
              //Not finished but avilable
              $good[$arr2[0]] = true;
              if($items != "")$items .= '|';
              $items .= $arr2[0];
            }else{
              //Not finished and not avilable
            }
          }
        }
      }else{
        // header("Location: index.php?error=notexist");
        exit();
      }
    }
  }

  {//University Courses (Must have)
    $sql = "SELECT * FROM university WHERE university = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: index.php?error=notexisst");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"s",$row['uuniversity']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($minfo = mysqli_fetch_assoc($result)){
        $arr = explode ("|", $minfo['mcourses']);
        $have = count($arr);

        for($i=0;$i<$have;$i= $i+1){
          $arr2 = explode (",", $arr[$i]);
          $dad += array($arr2[0] => $arr[$i]);
          if($items != "")$items .= '|';
          $items .= $arr2[0];
          if(isset($done[$arr2[0]]) && $done[$arr2[0]] == true){
            //Finised
          }else{
            //Red or blue
            $need = count($arr2) - 1;
            for($j = 1;$j<count($arr2);$j=$j+1){
              if(isset($out[$arr2[$j]])){
                $out[$arr2[$j]]++;
              }else{
                $out[$arr2[$j]] = 1;
              }
              if(isset($score[$arr2[$j]])){
                $score[$arr2[$j]]+=$direct_score;
              }else{
                $score[$arr2[$j]] = $direct_score;
              }
              if(isset($done[$arr2[$j]]) && $done[$arr2[$j]] == 1){
                $need--;
              }
            }
            if($need == 0){
              //Not finished but avilable
              $good[$arr2[0]] = true;
            }else{
              //Not finished and not avilable
            }
          }
        }

      }
    }

  }

  {//University Courses (Optinal have)
    $sql = "SELECT * FROM university WHERE university = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: index.php?error=notexisst");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"s",$row['uuniversity']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($minfo = mysqli_fetch_assoc($result)){
        $arr = explode ("|", $minfo['ocourses']);
        $have = count($arr);

        for($i=0;$i<$have;$i= $i+1){
          $arr2 = explode (",", $arr[$i]);

          $allf = false;
          for($j = 0;$j<count($arr2);$j++){
            $dad[$arr2[$j]] = $arr2[$j];
            if($items != "")$items .= '|';
            $items .= $arr2[$j];
            if(isset($done[$arr2[$j]]) && $done[$arr2[$j]] == true){
              array_push($orderc , '0'.','.$arr2[$j]);
              $allf = true;
            }
          }

          if($allf == false){
            for($j = 0;$j<count($arr2);$j++){
              $good[$arr2[$j]] = true;
            }
          }
        }

      }
    }

  }


  {//Top sort
    $arr = explode("|" , $items);
    $have = count($arr);
    // echo $dad['0301102']."</br>";
    for($i=0;$i<$have;$i= $i+1){
      $arr2 = explode (",", $arr[$i]);
      // echo $arr2[0].' '.$dad[$arr2[0]]."</br>";

      if(isset($score[$arr2[0]])){
        $score[$arr2[0]] += $level_score * substr($arr2[0] , strlen($arr2[0]) - 3 , 1);
      }else{
        $score[$arr2[0]] = $level_score * substr($arr2[0] , strlen($arr2[0]) - 3 , 1);
      }
      $sz[$arr2[0]] = 1;
      if(isset($out[$arr2[0]]) && $out[$arr2[0]] == 0){
        $len++;
        array_push($queue , $dad[$arr2[0]]);
      }else if(!isset($out[$arr2[0]])){
        $len++;
        array_push($queue , $dad[$arr2[0]]);
      }
    }

    $at = 0;
    for(;$at < $len;$at++){
      // echo "Hello ".$queue[$at]."</br>";
      $arr2 = explode (",", $queue[$at]);
      // print_r($sz
      // echo $arr2[0].' '.$sz[$arr2[0]]."</br>";
      if(isset($sz[$arr2[0]])){
        if(isset($score[$arr2[0]])){
          $score[$arr2[0]] += $undirect_score * $sz[$arr2[0]];
        }else{
          $score += array($arr2[0] => $undirect_score * $sz[$arr2[0]]);
        }
      }
      // echo count($arr2)."</br>";
      for($j = 1;$j<count($arr2);$j=$j+1){
        if(substr($arr2[$j],strlen($arr2[$j])-1,1) == "H")continue;
        // echo $arr2[$j].' '.$out[$arr2[$j]]."</br>";
        if(isset($out[$arr2[$j]])){
          $out[$arr2[$j]]--;
        }else{
          $out[$arr2[$j]] = 0;
        }
        if(isset($sz[$arr2[$j]])){
          $sz[$arr2[$j]] += $sz[$arr2[0]];
        }else{
          $sz += array($arr2[$j] => $sz[$arr2[0]]);
        }
        if(isset($dad[$arr2[$j]]) && $out[$arr2[$j]] == 0){
          //Add this course
          array_push($queue, $dad[$arr2[$j]]);
          $len++;
        }
      }
      // echo "</br>";
    }
    arsort($score);
  }
 ?>

 <html>
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>NAME ME PLZ</title>
 	<link rel="stylesheet" href="css/calc.css"  type="text/css">
 </head>
 <body>
 	<div id="calc">
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
          <!-- <div id="datahour">
            <span><?php echo $major_hourse - $finished; ?> : الساعات المتبقية</span>
          </div> -->
          <!-- <?php
            if($uname == $_COOKIE['uname']){
              echo '
              <form action="course_calculator.php" method="post">
      					<button type="submit" name="calc_course">Calc it</button>
      				</form>
              ';
            }
           ?> -->
  			</div>
  		</div>

      <div style="text-align: center;">
        <h1>
          ترتيب المواد حسب الاهمية
        </h1>
        <span>
          اهم المواد التي يجب عليك اجتيزاها لهذا الفصل حيث تم ترتيب هذه المواد وفق للمعلومات المخزنة في الموقع واليات حساب متقدمة
        </span>

      </div>
 		<div id="table">
      <div class="element" style="background-color:#00C851">
        <div class="subpnt">نقاط</div>
        <div class="subnum">رقم المادة</div>
        <div class="subnam">اسم المادة</div>
        <div class="idnum" >الرقم</div>
      </div>
      <?php
      {//print corses sorted
        // print_r($score);
        $at = 0;
        foreach ($score as $key => $value) {

          if(!isset($good[$key]) || !$good[$key])continue;
          $course_name = "none";
          $sql = "SELECT * FROM course WHERE id = ?";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: index.php?error=notexist");
            exit();
          }else{
            mysqli_stmt_bind_param($stmt,"s",$key);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($rows = mysqli_fetch_assoc($result)){
              $course_name = $rows['name'];
            }else{
              continue;
            }
          }
          $at++;

          $color = "white";
          if($at % 2 == 0)$color = "#e8e8e8";

          echo '
          <div class="element" style="background-color:'.$color.'">
          <div class="subpnt">'.$value.'</div>
   				<div class="subnum">'.$key.'</div>
   				<div class="subnam">'.$course_name.'</div>
   				<div class="idnum" >'.$at.'</div>
          </div>
          ';
          // exit();
        }
      }

       ?>

 		</div>
 	</div>
 </body>
 </html>
