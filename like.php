<?php
require 'includes/dbo.inc.php';

 $dd=$_POST['dd'];
 $user_id=$_POST['name'];
 $sql="SELECT * FROM likes WHERE (commentid='$dd' AND userid='$user_id');";
 $res=mysqli_query($conn,$sql);
 $rows=mysqli_num_rows($res);
 
 //if liked unlike it
 
 if($rows > 0){
     $sql = "DELETE FROM likes WHERE (commentid='$dd' AND userid='$user_id');";
     mysqli_query($conn, $sql);
     $sql="UPDATE comments SET likes = likes -1 WHERE id='$dd';";
 }else{
     $sql = "INSERT INTO likes (userid,commentid) VALUES ('$user_id','$dd');";
     mysqli_query($conn, $sql);
     $sql="UPDATE comments SET likes = likes +1 WHERE id='$dd';";
 }
 mysqli_query($conn, $sql);