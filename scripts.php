<script>
// deleting comment when the trash icon clicked from the comment owner

    $(document).ready(function(){
        $('.Del').click(function(){
            var u1=$(this).data('name');
            var u2="!!";
// Getting the current user name
            <?php if(isset($_COOKIE["uname"])){  $x=$_COOKIE["uname"];  ?>
                 u2 = '<?php echo $x; ?>';
                console.log(u2);
                    
            <?php } ?>
                
// pageid for adding the comment
            var p="0";
            <?php 
                if(isset($_GET['pid'])&&$_GET['pid']!=""){
                    $xx=$_GET['pid']; ?> 
                    p= '<?php echo $xx ;?> ';
                    console.log(p);
                <?php } ?>
                    
// if the user is the owner of the comment proceed             
            if(u1==u2){
                var x=$(this).data('id');
// sent a confirm to the user                
                if(confirm("Delete the comment?")){
                    $.ajax({
                        type:"POST",
                        url:"del.php",
                        data:"dd="+x,
                        success:function(){
//Update the comments
                            $.ajax({    
                                type: "GET",
                                url: "loadAllComments.php?pid="+p,             
                                dataType: "html",                 
                                success: function(response){                    
                                    $("#CommentsBlock").html(response);
                                    $(".ANY").hide();
                                }
                            });
                        }
                    });
                } 
            }
        });
    });
    
    
    
    
</script>
<script>
// Adding a like    
    $(document).ready(function(){
        $(".LIKE").click(function(){
// should be logged-in  (getting the user name & page id)          
            <?php if(isset($_COOKIE["uname"]) && $_COOKIE["uname"]!=""){ ?>
            var u;
            <?php if(isset($_COOKIE["uname"])){  $x=$_COOKIE["uname"];  ?>
                 u = '<?php echo $x; ?>';
                console.log(u);
                    
            <?php } ?>
                
            var p="0";
            <?php 
            if(isset($_GET['pid'])&&$_GET['pid']!=""){
                $xx=$_GET['pid']; ?> 
                 p= '<?php echo $xx ;?> ';
                 console.log(p);
             <?php } ?>
// comment id                  
             var x=$(this).data('id');
             $.ajax({
                 type:"POST",
                 url:"like.php",
                 data:"dd="+x+"&name="+u,
                 success:function(){
// upadte the comments
                    $.ajax({    
                        type: "GET",
                        url: "loadAllComments.php?pid="+p,             
                        dataType: "html",                 
                        success: function(response){                    
                             $("#CommentsBlock").html(response);
                             $(".ANY").hide();
                        }

                    });
                 }
                       
             });
             <?php } ?>
        });
    });
    
</script>