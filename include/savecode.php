<?php
//remove this in future version
session_start();
include "config.php"; 
if(isset($_POST)){
  $code=$_POST['code'];
  file_put_contents($_SESSION['dir']."/".$_SESSION['file'],$code);
  header("Location: ../html/editor.php");
}
?>