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
if(!isset($coursename['name'])){
    header("Location: commentMainPage.php");
    exit;
}?>
<?php require 'header.php'; 
 
  ?>
<!DOCTYPE html>
<html>
    <head>
        
        <head>
            
        <link rel="stylesheet" href="css/cmp.css" />   
        <link rel="stylesheet" href="css/commentStyle.css" />
        <link rel="stylesheet" href="css/header.css" />
        <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/lib/jquery.min.js"></script>
        <script src="jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
        
        <title>Discussion Page</title>
    </head>
    <script>
// Adding a new comment    
        $(document).ready(function() {
            $('#adding').submit(function(e){
                e.preventDefault();
                var n = $('#txt').val();
                var u ="";
                
                
// see if someone logged in
                <?php if (isset($_COOKIE["uname"])){
                
                    $x=$_COOKIE["uname"]; ?>
                                u= '<?php echo $x; ?>';
                                
                                console.log(u);
                <?php } ?>
                    
                    
// get the pageid for the comment            
                    var p=0;
                    <?php
                    if(isset($_GET['pid'])&&$_GET['pid']!=""){
                    
                        $xx=$_GET['pid']; ?>
                    p ='<?php echo $xx; ?>';
                    console.log(p);
                    <?php } ?>
                        
// use ajax to add the comment 
                $.ajax({
                    type:"POST",
                    url:"addComment.php",
                    data: "subject="+n+"&p=0"+"&name="+u+"&pageid="+p,
                    success: function(){
//empty the textarea and disable the Add button
                    $("#txt").val('');
                    $('.mainB').prop('disabled',true);
                    
//Update the comments by ajax call
                    $.ajax({
                        type: "GET",
                        url: "loadAllComments.php?pid="+p,
                        dataType: "html",
                        success: function (response) {
                            $("#CommentsBlock").html(response);
//Hide any edit/reply boxes                            
                            $(".ANY").hide();
                        }
                    });
                }
                });
                
            });
        });
    
    
    
    </script>
    <script>
// Disabling the button while there is no current user OR the textarea is empty        
        
       $(document).ready(function(){
           $('#txt').val('');
           $('.mainB').prop('disabled', true);
           <?php if(isset($_COOKIE["uname"])&& $_COOKIE["uname"]!="" ) { ?>
                         
                        $('#txt').keyup(function(){
                            
                       if($.trim($('#txt').val()).replace(' ','') == ''){
                        $('.mainB').prop('disabled', true);
                        }else{
                        $('.mainB').prop('disabled', false);
                        }
                   });
           <?php } else { ?>
               $('.mainB').prop('disabled', true);
           <?php } ?>
       });
    </script>
    
    <script>
// Loading the comments from the database
    $(document).ready(function(){
// get pageid
    var p=0;
    <?php 
    if(isset($_GET['pid'])&&$_GET['pid']!=""){
       $xx=$_GET['pid']; ?> 
         p= '<?php echo $xx ;?> ';
         console.log(p);
    <?php } ?>
    
    $.ajax({
        type: "GET",
                url: "loadAllComments.php?pid="+p,
                dataType: "html",
                success: function (response) {
                    $("#CommentsBlock").html(response);
                    $(".ANY").hide();
                }
    });
    });
    
    </script>    
    <body>
    

    <hr>
    <div class="down">
        <div  id="CommentsBlock">
            
                
                    
                

<!--
                
                
                <div class="ncomment mn">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">UserName : </laber>
                    <div  class="w">
                    dd/mm/yyyy hh:mm:ss
                </div>
                </div>
                    
                    <div class="mainc">
                        welcom to the arabic site 
                    </div>
                    <br>
                    <div class="rightc">
                    
                    <i class="fas fa-thumbs-up" style="float:right;margin-left: 3%">()</i>
                    <i class="fas fa-reply" style="float:right;margin-left: 3%"></i>
                    <i class="fas fa-trash-alt" style="float:right;margin-left: 3%"></i>
                    <i class="far fa-edit" style="float:right;margin-left: 3%"></i>
                </div>
                </div>

                
                
                
                <div  class="rcomment re">
                    <br>
                    <div class="uside">
                    <laber style="font-weight: bold;">UserName : </laber>
                    <div class="w">
                    dd/mm/yyyy hh:mm:ss
                </div>
                </div>
                    
                    <div class="mainc">
                        welcom to the arabic site 
                    </div>
                    
                    <div class="rightc">
                    
                    <i class="fas fa-thumbs-up" style="float:right;margin-left: 3%">(5)</i>
                    <i class="fas fa-reply" style="float:right;margin-left: 3%"></i>
                    <i class="fas fa-trash-alt" style="float:right;margin-left: 3%"></i>
                    <i class="far fa-edit" style="float:right;margin-left: 3%"></i>
                </div>
                </div>

                <div class="rcomment re">
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
                       
                    
                -->

                        



                   


                       
                            
            
        </div>
    </div>
    <hr>

    <!-- THe submit form goes here -->
    <div class="sb">
            <form method="POST" id="adding" >
                        <label>
                            <h2 style="text-align:center">Add Comment</h2>
                            <textarea class="tsb" name="subject" id="txt"></textarea>
                            <button class="bsb mainB" type="submit">Add</button>
                        </label>
                    </form>
                
    </div>
        
        
        
    </body>
    
    
    
   <?php require 'footer.php'; ?> 
</html>