<?php

require 'includes/dbo.inc.php';
require 'scripts.php';
if(isset($_GET['pid'])&&$_GET['pid']!="")$pageid=mysqli_real_escape_string($conn,$_GET['pid']);
else $pageid="0";

//searching for the pageid in db
$sql="SELECT * FROM course WHERE id='$pageid';";
$res = mysqli_query($conn,$sql);
$coursename=mysqli_fetch_assoc($res);
$sql = " SELECT * FROM comments WHERE (place=0 AND pageid='$pageid') ORDER BY place ASC , likes DESC ;";
$res = mysqli_query($conn,$sql);

//return to comments page if wrong page id

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
                if(liked($r['id'])==true){    
                    echo '<a class="LIKE" data-id='.$r["id"].'>'
                    . '<i id='.$r["id"].' class="fas fa-thumbs-up" style="float:right;margin-left: 3%;color:blue;">('.$r["likes"].')</i>'
                            . '</a>';
                }else{
                    echo '<a class="LIKE" data-id='.$r["id"].'>'
                            . '<i id='.$r["id"].' class="far fa-thumbs-up" style="float:right;margin-left: 3%;color:black;">('.$r["likes"].')</i>'
                            . '</a>';
                }
                            
                    echo '<i class="fas fa-reply rep" style="float:right;margin-left: 3%;color:black"></i>
                    <a class="Del" data-id='.$r["id"].' data-name='.$r["name"].'><i class="fas fa-trash-alt"  style="float:right;margin-left: 3%"></i></a>
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
// find if user liked the comment before  
  function liked($d){
      require 'includes/dbo.inc.php';
      if(!isset($_COOKIE['uname']) || $_COOKIE['uname'] =="")return false;
      
      $user_id=$_COOKIE['uname'];
      $sql="SELECT * FROM likes WHERE (commentid='$d' AND userid='$user_id');";
      $res= mysqli_query($conn, $sql);
      $rows=mysqli_num_rows($res);
      if($rows>0)return true;
      else return false;
  }
?>