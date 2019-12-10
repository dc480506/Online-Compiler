<?php
// descriptor array
include "config.php";
$json = file_get_contents('php://input');
$jsonArray=json_decode($json,true);
$wd=$base_dir.$jsonArray['code_path'];
$input=$jsonArray['input'];
file_put_contents($wd."/input1.txt",$input);
rename($wd."/input1.txt",$wd."/input.txt");
?>