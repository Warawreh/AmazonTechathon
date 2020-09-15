<?php
//open db
require 'dbo.inc.php';
//check if logged
$logged = false;
if(isset($_COOKIE['uname'])){
  $logged = true;
}

//get the user who you want to get his courses
if(!isset($_GET['user'])){
  header("Location: index.php?error=notexist");
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


if($_GET['user'] == $_COOKIE['uname']){//Check if subjects is removed or added
  //Make changes
  // exit();
  if(isset($_GET['add'])){
    echo '<script type="text/javascript"> alert("Hello") </script>';
    // echo $student_course."</br>";
    if($student_course != "")$student_course.='|';
    $student_course .= $_GET['add'];
    // echo $student_course;
  }
  if(isset($_GET['remove'])){
    $remove = $_GET['remove'];
    $finishedsub = explode ("|", $student_course);
    for($i=0;$i < count($finishedsub) ;$i = $i + 1){
      if($finishedsub[$i] == $remove){
        $student_course = "";
        for($j=0;$j < $i ;$j = $j + 1){
          if($finishedsub[$j] == "")continue;
          if(strlen($student_course) != 0)$student_course .= '|';
          $student_course .= $finishedsub[$j];
        }
        for($j=$i+1;$j < count($finishedsub) ;$j = $j + 1){
          if($finishedsub[$j] == "")continue;
          if(strlen($student_course) != 0)$student_course .= '|';
          $student_course .= $finishedsub[$j];
        }
        break;
      }
    }
  }
  if(isset($_GET['add']) || isset($_GET['remove'])){
    $sql = "UPDATE userinfo SET courses=? WHERE uname=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      // header("Location: index.php?error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"ss",$student_course,$uname);
      mysqli_stmt_execute($stmt);
      // header("Location: profile.php?user=".$uname.");
      // exit();
    }
  }
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
      if(!isset($course_hour[$arr2[0]])){
        continue;
      }
      // echo $arr2[0].' '.$course_hour[$arr2[0]]."</br>";
      $finished += $course_hour[$arr2[0]];
      $done[$arr2[0]] = true;
    }
  }
}

if($logged && $_COOKIE['uname'] == $uname){
  //Start ordering
  $orderc = array();
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

        for($i=0;$i<$have;$i= $i+1){
          $arr2 = explode (",", $arr[$i]);

          if(isset($done[$arr2[0]]) && $done[$arr2[0]] == true){
            //Finised
            array_push($orderc , '0'.','.$arr2[0]);
          }else{
            //Red or blue
            $need = count($arr2) - 1;
            for($j = 1;$j<count($arr2);$j=$j+1){
              if(isset($done[$arr2[$j]]) && $done[$arr2[$j]] == 1){
                $need--;
              }
            }

            if($need == 1 && substr($arr2[1],strlen($arr2[1]) - 1,1) == "H"){
              if($finished >= substr($arr2[1],0,strlen($arr2[1]) - 1)){
                $need = 0;
              }
            }

            if($need == 0){
              //Not finished but avilable
              array_push($orderc , '1'.','.$arr2[0]);
            }else{
              //Not finished and not avilable
              array_push($orderc , '2'.','.$arr2[0]);
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
        $have = count($arr);
        $needed_houers = $arr[0];

        for($i=1;$i<$have;$i= $i+1){
          $arr2 = explode (",", $arr[$i]);
          if(isset($done[$arr2[0]]) && $done[$arr2[0]] == true){
            //Finised
            $needed_houers -= 3;
          }
        }

        for($i=1;$i<$have;$i= $i+1){
          $arr2 = explode (",", $arr[$i]);

          if(isset($done[$arr2[0]]) && $done[$arr2[0]] == true){
            //Finised
            array_push($orderc , '0'.','.$arr2[0]);
          }else if($needed_houers != 0){
            //Red or blue
            $need = count($arr2) - 1;
            for($j = 1;$j<count($arr2);$j=$j+1){
              if(isset($done[$arr2[$j]]) && $done[$arr2[$j]] == 1){
                $need--;
              }
            }
            // echo $arr2[0].' '.$need."</br>";

            if($need == 1 && substr($arr2[1],strlen($arr2[1]) - 1,1) == "H"){
              if($finished >= substr($arr2[1],0,2)){
                $need = 0;
              }
            }

            if($need == 0){
              //Not finished but avilable
              array_push($orderc , '1'.','.$arr2[0]);
            }else{
              //Not finished and not avilable
              array_push($orderc , '2'.','.$arr2[0]);
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

          if(isset($done[$arr2[0]]) && $done[$arr2[0]] == true){
            //Finised
            array_push($orderc , '0'.','.$arr2[0]);
          }else{
            //Red or blue
            $need = count($arr2) - 1;
            for($j = 1;$j<count($arr2);$j=$j+1){
              if(isset($done[$arr2[$j]]) && $done[$arr2[$j]] == 1){
                $need--;
              }
            }
            if($need == 0){
              //Not finished but avilable
              array_push($orderc , '1'.','.$arr2[0]);
            }else{
              //Not finished and not avilable
              array_push($orderc , '2'.','.$arr2[0]);
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
            if(isset($done[$arr2[$j]]) && $done[$arr2[$j]] == true){
              array_push($orderc , '0'.','.$arr2[$j]);
              $allf = true;
              break;
            }
          }

          if($allf == false){
            for($j = 0;$j<count($arr2);$j++){
              array_push($orderc , '1'.','.$arr2[$j]);
            }
          }
        }
      }
    }

  }

  $at = 0;
  $course_names = [];
  $sql = "SELECT * FROM course";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: index.php?error=notexist");
    exit();
  }else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($rows = mysqli_fetch_assoc($result)){
      $course_names[$rows['id']] = $rows['name'];
    }
  }
  foreach ($orderc as $course) {
    $arr2 = explode (",", $course);
    $course_name = $course_names[$arr2[1]];
   // echo $arr2[1].' '.$course_name."</br>";
    $orderc[$at] = $arr2[0].','.substr($arr2[1],4,1).",".$course_name.",".$arr2[1];
    $at++;

  }
  $items = "";
  sort($orderc);
  //check if there is a search filter
  if(isset($_GET['search']) && $_GET['search'] != ""){
    $search_for =  $_GET['search'];
    foreach ($orderc as $course) {
      $arr2 = explode (",", $course);
      // echo $arr2[0].' '.$arr2[1].' '.$arr2[2]."</br>";

      $pos = strpos($course, $search_for);

      if($pos){
        if($arr2[0] == 0){
          $items .= '<div class="done"  style="background-color:#00C851" onclick="removecourse(\''.$arr2[3].'\')"> <span style="color:white;font-weight:900">&#10003;</span> </br> '.$arr2[2].' </div>';
        }else if($arr2[0] == 1){
          $items .=  '<div class="open" style="background-color:#33b5e5" onclick="addcourse(\''.$arr2[3].'\')">  &#128275; </br> '.$arr2[2].'</div>';
        }else if($arr2[0] == 2){
          $items .=  '<div class="close" style="background-color:#ffbb33"> &#128274; </br>  '.$arr2[2].' </div>';
        }
      }

    }
  }else{
    foreach ($orderc as $course) {
      $arr2 = explode (",", $course);
      // echo $arr2[0].' '.$arr2[1].' '.$arr2[2]."</br>";

      if($arr2[0] == 0){
        $items .= '<div class="done"  style="background-color:#00C851" onclick="removecourse(\''.$arr2[3].'\')"> <span style="color:white;font-weight:900">&#10003;</span> </br> '.$arr2[2].' </div>';
      }else if($arr2[0] == 1){
        $items .=  '<div class="open" style="background-color:#33b5e5" onclick="addcourse(\''.$arr2[3].'\')">  &#128275; </br> '.$arr2[2].'</div>';
      }else if($arr2[0] == 2){
        $items .=  '<div class="close" style="background-color:#ffbb33"> &#128274; </br>  '.$arr2[2].' </div>';
      }

    }

  }
}


//close db
mysqli_stmt_close($stmt);
mysqli_close($conn);
echo $items;
 ?>
