<?php
require 'includes/dbo.inc.php';

$dd=$_POST['dd'];
$newText=mysqli_real_escape_string($conn,$_POST['txt']);
$sql="UPDATE comments SET subject='$newText' WHERE id='$dd';";
mysqli_query($conn,$sql);