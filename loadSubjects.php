<?php
require 'includes/dbo.inc.php';


// if College was selected take only it's subjects
if(isset($_GET['inst'])&& $_GET['inst']!=""){
    $x = $_GET['inst'];
    $sql = "SELECT * FROM course WHERE inst='$x';";
}
else{ // take all subjects
    $sql="SELECT * FROM course";
}

$res = mysqli_query($conn, $sql);

while($r = mysqli_fetch_assoc($res)){
    echo '<a href="CommentPage.php?pid='.$r["id"].'">
            <button class="sbtn">'.$r["name"].'</button>
                </a>
            ';
}
