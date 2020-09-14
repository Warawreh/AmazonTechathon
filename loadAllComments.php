<?php
require 'includes/dbo.inc.php';

if(isset($_GET['pid'])&&$_GET['pid']!="")$pageid=mysqli_real_escape_string($conn,$_GET['pid']);
else $pageid="0";

//searching for the pageid in db
$sql="SELECT * FROM course WHERE id='$pageid';";
$res = mysqli_query($conn,$sql);
$coursename=mysqli_fetch_assoc($res);
$sql = " SELECT * FROM comments WHERE (place=0 AND pageid='$pageid') ORDER BY place ASC , likes DESC ;";
$res = mysqli_query($conn,$sql);

//return to comments page if wrong page id
if(!isset($coursename['name'])){
    header("Location: commentMainPage.php");
    exit;
}
  echo '<h1 style="text-align: center">'.$coursename["name"].' Comments</h1>';

// print all the comments (with edit/replty hidden boxes) 
  while($r = mysqli_fetch_assoc($res)){
      echo ' <div class="ncomment mn">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">'.$r["name"].' : </laber>
                    <div class="w">
                    '.$r["date"].'
                </div>
                </div>
                    
                    <div class="mainc">
                        '.htmlspecialchars($r["subject"]).'
                    </div>
                    <br>
                    <div class="rightc">';
 // Check if user already liked this (function liked)
                    
                    echo '<i class="fas fa-thumbs-up LIKE" style="float:right;margin-left: 3%;color:blue;">('.$r["likes"].')</i>';
                    
                            
                    echo '<i class="far fa-reply rep" style="float:right;margin-left: 3%;color:black"></i>
                    <i class="fas fa-trash-alt Del" style="float:right;margin-left: 3%"></i>
                    <i class="far fa-edit EDIT" style="float:right;margin-left: 3%"></i>
                </div>
                </div>
                
                <div class="ncomment ed ANY">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">Edit your comment : </laber>
                    
                </div>
                    
                    <div class="mainc">
                        <textarea class="earea"></textarea>
                    </div>
                    
                    <div class="rightc">
                    
                        <button class="ebtn">Submit</button>
                </div>
                </div>
                

                <div class="ncomment re ANY">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">Replying to Username : </laber>
                    
                </div>
                    
                    <div class="mainc">
                        <textarea class="earea"></textarea>
                    </div>
                    
                    <div class="rightc">
                    
                        <button class="ebtn">Submit</button>
                </div>
                </div>
    ';
  }
  
  