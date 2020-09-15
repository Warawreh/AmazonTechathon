<?php
require 'includes/dbo.inc.php';

    $row_no=$_POST['dd'];
    $sql = "DELETE FROM comments WHERE id='$row_no';";
    $res= mysqli_query($conn, $sql);
    
    if(!$res)exit;
// delete the likes/replies in this comment    
    $sql="SELECT id FROM comments WHERE place='$row_no';";
    $res = mysqli_query($conn, $sql);
    while($r = mysqli_fetch_assoc($res)){
        $x=$r['id'];
        $sql="DELETE FROM comments WHERE id='$x';";
        mysqli_query($conn, $sql);
        $sql="DELETE FROM likes WHERE commentid-'$x';";
        mysqli_query($conn, $sql);
    }