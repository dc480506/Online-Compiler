<?php
session_start();
if(isset($_SESSION['u_user'])){
$pid=$_SESSION['pid'];
/*echo $pid;
ob_flush();
flush();*/
shell_exec("kill -9 ".$pid." ".($pid+1));
}
?>