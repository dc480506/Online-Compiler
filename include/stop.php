<?php
include "config.php";
$json = file_get_contents('php://input');
$jsonArray=json_decode($json,true);
$pid=$jsonArray['pid'];
shell_exec("kill -9 ".$pid." ".($pid+1));

?>