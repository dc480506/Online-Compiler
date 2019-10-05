<?php
include "config.php"; 
  /*$_file=$_POST['file'];
  $code=$_POST['code'];*/
  $json = file_get_contents('php://input');
  $jsonArray=json_decode($json,true);
  $dir=$base_dir.$jsonArray['file'];
  file_put_contents($dir,$jsonArray['codetext']);
  echo $dir."\n".$jsonArray['codetext'];
  //file_put_contents($_file,$code);
?>