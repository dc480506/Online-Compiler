<?php
session_start();
include "config.php";
/*$json = file_get_contents('php://input');
$jsonArray=json_decode($json,true);
$wd=$base_dir.$jsonArray['code_path'];
$lang=$jsonArray['lang'];*/
$wd=$_SESSION['dir']."/*";
$lang=$_SESSION['language'];
$des=$_SESSION['runfolder']."/";
chdir($_SESSION['dir']);
shell_exec("cp -r $wd $des");
if($lang=="Java"){
  // if(file_exists("Main.class"))
  //   unlink("Main.class");
  echo shell_exec("javac -d ".$_SESSION['runfolder']." ".$_SESSION['file']." 2>&1");
}else if($lang=="C"){
  // if(file_exists("a.out"))
  //   unlink("a.out");
  echo shell_exec("gcc ".$_SESSION['file']." -o ".$_SESSION['runfolder']."/a.out 2>&1"); //Added for virtualization
}else if($lang=="C++"){
//  if(file_exists("a.out"))
//     unlink("a.out");
 //  echo shell_exec("g++ ".$_SESSION['file']." 2>&1");
 echo shell_exec("g++ ".$_SESSION['file']." -o ".$_SESSION['runfolder']."/a.out 2>&1");
}
?>