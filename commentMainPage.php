<?php
require 'header.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/cmp.css" type="text/css"/>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/web_icon.jpg">
	<meta charset="UTF-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        
        <title>Discussion Page</title>
    </head>
    <script>
    $(document).ready(function(){
        $("#firstChoice").attr('selected',true);
        $.ajax({
            type:"GET",
            url:"loadSubjects.php",
            dataType:"html",
            success:function(response){
                $(".SBlock").html(response);
            }
        });
    });
    </script>
    <script>
    
    $(document).ready(function(){
        $("option").click(function(){
            var x = $(this).data("id");
            $.ajax({
                type:"GET",
            url:"loadSubjects.php?inst="+x,
            dataType:"html",
            success:function(response){
                $(".SBlock").html(response);
            }
            });
        });
        
    });
    
    
    </script>
    <body>
        <div class="down">
            <h1 style="text-align:right">
                <div class="b1">
                    المواد الدراسية
                </div>
            </h1>
            
            <div class="b2">
                <h2 style="text-align: right">
                    الكليّة
                
                    <br>
                <select id="se" class="sel">
                    <option data-id="" disabled selected>اختر كلية</option>
                    <option data-id="" id="firstChoice">عام</option>
                    <option data-id="geo">الهندسة</option>
                    <option data-id="nur">التمريض</option>
                    <option data-id="med">الطب</option>
                    <option data-id="bus">الاعمال</option>
                </select>
                </h2>
                
                
            </div>
            
        </div>
        <br><br><br><br><br>
        <div class="line"></div>
        <div class="btns SBlock">
            
        </div>
        
    </body>
    
    
    
    
</html>