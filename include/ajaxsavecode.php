<?php
session_start();
if(isset($_SESSION['u_user'])){
  include "config.php"; 
  $filepath=$_SESSION['dir']."/".$_SESSION['file'];
  session_write_close();
  $json = file_get_contents('php://input');
  $jsonArray=json_decode($json,true);
  file_put_contents($filepath,$jsonArray['codetext']);
  echo $filepath."\n".$jsonArray['codetext'];
}
  //file_put_contents($_file,$code);
?>