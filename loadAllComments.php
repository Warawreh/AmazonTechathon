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
                            
                    echo '<a class="rep" data-id='.$r["id"].'><i class="fas fa-reply" style="float:right;margin-left: 3%;color:black"></i></a>
                    <a class="Del" data-id='.$r["id"].' data-name='.$r["name"].'><i class="fas fa-trash-alt"  style="float:right;margin-left: 3%"></i></a>
                    <a class="EDIT" data-id='.$r["id"].' data-name='.$r["name"].'>     <i class="far fa-edit" style="float:right;margin-left: 3%"></i>      </a>
                </div>
                </div>
                
                <div class="ncomment ed ANY '.$r["id"].' ">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">Edit your comment : </laber>
                    
                </div>
                    
                    <div class="mainc">
                        <textarea class="earea S'.$r["id"].'">'.htmlspecialchars($r["subject"]).'</textarea>
                    </div>
                    
                    <div class="rightc">
                    
                        <button data-id='.$r["id"].' class="ebtn UEDIT">Submit</button>
                </div>
                </div>
                

                <div class="ncomment re ANY R'.$r["id"].'">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">Replying to '.$r["name"].' : </laber>
                    
                </div>
                    
                    <div class="mainc">
                        <textarea class="earea RS'.$r["id"].'"></textarea>
                    </div>
                    
                    <div class="rightc">
                    
                        <button class="ebtn Repl" data-id='.$r["id"].' data-place='.$r["id"].' >Submit</button>
                </div>
                </div>
    ';
                    
// load the replies to each comment
    $idd=$r['id'];
    $sql = "SELECT * FROM comments WHERE place='$idd' ORDER BY likes DESC";
                
                if(mysqli_num_rows(mysqli_query($conn, $sql))>0){
                    $ress = mysqli_query($conn, $sql);
                    while($v = mysqli_fetch_assoc($ress)){
                        echo'<div class="rcomment re">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">'.$v["name"].' : </laber>
                    <div class="w">
                    '.$v["date"].'
                </div>
                </div>
                    
                    <div class="mainc">
                        '.htmlspecialchars($v["subject"]).'
                    </div>
                    <br>
                    <div class="rightc">';
 // Check if user already liked this (function liked)
                if(liked($v['id'])==true){    
                    echo '<a class="LIKE" data-id='.$v["id"].'>'
                    . '<i id='.$v["id"].' class="fas fa-thumbs-up" style="float:right;margin-left: 3%;color:blue;">('.$v["likes"].')</i>'
                            . '</a>';
                }else{
                    echo '<a class="LIKE" data-id='.$v["id"].'>'
                            . '<i id='.$v["id"].' class="far fa-thumbs-up" style="float:right;margin-left: 3%;color:black;">('.$v["likes"].')</i>'
                            . '</a>';
                }
                            
                    echo '<a class="rep" data-id='.$v["id"].'><i class="fas fa-reply" style="float:right;margin-left: 3%;color:black"></i></a>
                    <a class="Del" data-id='.$v["id"].' data-name='.$v["name"].'><i class="fas fa-trash-alt"  style="float:right;margin-left: 3%"></i></a>
                    <a class="EDIT" data-id='.$v["id"].' data-name='.$v["name"].'>     <i class="far fa-edit" style="float:right;margin-left: 3%"></i>      </a>
                </div>
                </div>';
                    
                    
                    echo '<div class="rcomment ed ANY '.$v["id"].' ">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">Edit your comment : </laber>
                    
                </div>
                    
                    <div class="mainc">
                        <textarea class="earea S'.$v["id"].'">'.htmlspecialchars($v["subject"]).'</textarea>
                    </div>
                    
                    <div class="rightc">
                    
                        <button data-id='.$v["id"].' class="ebtn UEDIT">Submit</button>
                </div>
                </div>';
                    
                    echo '<div class="rcomment re ANY R'.$v["id"].'">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">Replying to '.$v["name"].' : </laber>
                    
                </div>
                    
                    <div class="mainc">
                        <textarea class="earea RS'.$v["id"].'"></textarea>
                    </div>
                    
                    <div class="rightc">
                    
                        <button class="ebtn Repl" data-id='.$v["id"].' data-place='.$r["id"].' >Submit</button>
                </div>
                </div>';
                    }
                }
                    
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