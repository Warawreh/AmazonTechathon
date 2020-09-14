<!-- ***Done Todo : Check if admin -->
<?php
  require 'header.php';
  $admin_names = array("admin_master1","admin_mater2","admin_master3");
  $cnt = count($admin_names);
  $is_admin = true;
  for($i = 0;$i < $cnt;$i++){
    if($admin_names[$i] == $user_name){
      $is_admin = true;
    }
  }

  if(!$is_admin){
    header("Location: index.php");
    exit();
  }
 ?>
 <!-- ***Done Todo : Create addcourse.inc.php to save course to the database -->
</br></br></br></br>
<!-- Adding Courses to the data base -->
<span style="font-size:30px">Add Course</span></br></br>

<form method="post" action="includes/addcourse.inc.php">
  <!-- Every course has an id from it's university -->
  <input autofocus type="text" placeholder="course id" name="cid">
  <!-- Course name -->
  <input type="text" placeholder="course name" name="cname">

  <!-- Course University (currently only JU) -->
  <select name="cuni">
    <option>Jordan University</option>
  </select>
  <!-- Hours of the course (1 , 2 or 3) -->
  <input type="text" placeholder="course hours" name="chour">
  <!-- Submit Course to data base -->
  <button type="submit" name="course-submit">Save</button>
</form>

<!-- ___________________________________________________ -->

</br>

<!-- Adding Majors to the db -->
<span style="font-size:30px">Add Major</span></br></br>
<!-- ***Done Todo : Create addmajor.inc.php to save major to the database -->
<form method="post" action="includes/addmajor.inc.php">
  <!-- Major name -->
  <input type="text" placeholder="Major name" name="mname">

  <!-- <Major University (currently only JU) -->
  <select name="muni">
    <option>Jordan University</option>
  </select>
  <!-- Major Facility -->
  <select name="mfac">
    <option>Arts</option>
    <option>Business</option>
    <option>Engineering</option>
  </select>
  <!-- Hours of the Majors -->
  <input type="text" placeholder="Major hours" name="mhour">
  </br></br>
  <!-- Add courses of this major -->
  <input name="mcourse" type="text" id="allcourse" style="width:100%">
  <br>
  <br>
  <input type="text" id="added" placeholder="Course" style="width:30%">
  <button type="button" onclick="AddCourse()">add</button>
  </br> </br>
  <button type="submit" name="major-submit">Save</button>
</form>

<script type="text/javascript">
  function AddCourse(){
    var current = document.getElementById("added").value;
    document.getElementById("added").value = "";
    if(document.getElementById("allcourse").value != "")document.getElementById("allcourse").value += '|';
    if(current.substring(current.length - 1))current = current.substring(0,current.length - 1);
    document.getElementById("allcourse").value += current;
  }
  document.getElementById('added').addEventListener('keyup', function(event) {
      if (event.keyCode == 32) {
          AddCourse();
      }
  });
</script>
