<?php
include "config.php";
$json = file_get_contents('php://input');
$jsonArray=json_decode($json,true);
$wd=$base_dir.$jsonArray['code_path'];
$lang=$jsonArray['lang'];
chdir($wd);
if($lang=="Java"){
  if(file_exists("Main.class"))
    unlink("Main.class");
  echo shell_exec("javac Main.java 2>&1");
  echo shell_exec("java Main 2>&1; echo $?");
}else if($lang=="C"){
  if(file_exists("a.exe"))
    unlink("a.exe");
  echo shell_exec("gcc main.c 2>&1");
//echo shell_exec("a");
}else if($lang=="C++"){
 if(file_exists("a.exe"))
    unlink("a.exe");
   echo shell_exec("g++ main.cpp 2>&1");
}
?>