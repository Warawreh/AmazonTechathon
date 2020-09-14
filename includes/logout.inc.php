<?php
  //Just clear the name form cookies
  setcookie("uname", "", time() - 3600,"/");
  header("Location: ../index.php");
 ?>
