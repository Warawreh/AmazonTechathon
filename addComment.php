<?php
require 'includes/dbo.inc.php';
    $subject = mysqli_real_escape_string($conn,$_POST['subject']);
    $name = $_POST['name'];
    $date = date('Y/m/d h:i:s',time());
    $place = $_POST['p'];
    $pageid = mysqli_real_escape_string($conn,$_POST['pageid']);
    
    $sql="INSERT INTO comments (name , date , subject , likes , place , pageid) VALUES ('$name','$date','$subject','0','$place','$pageid');";
    
    mysqli_query($conn, $sql);
