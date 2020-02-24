<?php
// descriptor array
session_start();
include "config.php";
$json = file_get_contents('php://input');
$jsonArray=json_decode($json,true);
<<<<<<< HEAD
$wd=$_SESSION['runfolder'];
=======
$wd=$_SESSION['dir'];
>>>>>>> meet
$input=$jsonArray['input'];
file_put_contents($wd."/input1.txt",$input);
rename($wd."/input1.txt",$wd."/input.txt");
?>