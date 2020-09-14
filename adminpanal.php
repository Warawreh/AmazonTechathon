<!-- Todo : Check if admin -->
<?php
  
  $admin_names = ("admin_master1","admin_mater2","admin_master3");
  $cnt = count($admin_names);
  $is_admin = false;
  for($i = 0:$i < $cnt;$i++){
    if($admin_names[$i] == $user_name){
      $is_admin = true;
    }
  }
  if(!$is_admin){
    header("Location: index.php");
    exit();
  }
 ?>

<!-- Adding Courses to the data base -->
<span style="font-size:30px">Add Course</span></br></br>

<!-- Todo : Create addcourse.inc.php to save course to the database -->
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
