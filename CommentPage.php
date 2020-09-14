<?php require 'header.php'; 
 require 'method.php';
  ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/commentStyle.css" />
        <link rel="stylesheet" href="css/header.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/phoneStyle.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 801px)" href="css/tablet.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
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
                   $('txt').keyup(function(){
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
                       
                    
                

                        



                   


                       
                            
            
        </div>
    </div>
    <hr>

    <!-- THe submit form goes here -->
    <div class="sb">
            <form method="POST" id="adding">
                        <label>
                            <h2 style="text-align:center">Add Comment</h2>
                            <textarea class="tsb" name="subject" id="txt"></textarea>
                            <button class="bsb mainB">Add</button>
                        </label>
                    </form>
                
    </div>
        
        
        
    </body>
    
    
    
    
</html>