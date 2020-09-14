<?php
  //Todo : Convert from local db to server db when ready
  //Todo : Find A font for the logo
  $servername = "localhost"; //servername
  $dbuname = "root";//db user name
  $dbpwd  = "";//db password
  $dbname = "unisa";// db name

  $conn = mysqli_connect($servername,$dbuname,$dbpwd,$dbname);

  if(!$conn){//Kill connection when error occuer 
    die("Connection Faild: ".mysqli_connect_error());
  }

?>
