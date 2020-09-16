<?php
require 'includes/dbo.inc.php';


// if College was selected take only it's subjects
if(!isset($_GET['search']) || $_GET['search'] == ""){
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
}


else{
    $sql="SELECT * FROM course";
    $a= mysqli_query($conn, $sql);
    $q=$_GET['search'];
    $hint="";
    
    
        $len=strlen($q);
    while($r = mysqli_fetch_assoc($a)) {
        
        if (stristr($q, substr($r["name"], 0, $len))) {
            $hint .= ', <a href="CommentPage.php?pid='.$r["id"].'">
            <button class="sbtn">'.$r["name"].'</button>
                </a> ';
            
        }
        else if(strpos($r["name"], $q)){
            $hint .= ', <a href="CommentPage.php?pid='.$r["id"].'">
            <button class="sbtn">'.$r["name"].'</button>
                </a> ';
            }
        
    }
    
            
        

// Output "no suggestion" if no hint was found or output correct values
echo $hint;
}
