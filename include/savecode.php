<?php
include "config.php"; 
if(isset($_POST)){
  $code=$_POST['code'];
  file_put_contents("Main.java",$code);
  header("Location: ../html/editor.php");
}
?>