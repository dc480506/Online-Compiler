<?php
session_start();
include_once "config.php";
$_SESSION['dir']=$base_dir.$_SESSION['u_user']."/".$_POST['code-name'];
$_SESSION['file']="";
$_SESSION['language']=$_POST['code-lang'];
$_SESSION['code']=$_POST['code-name'];
if($_POST['code-lang']=="C"){
    $_SESSION['file']="main.c";
}else if($_POST['code-lang']=="C++"){
    $_SESSION['file']="main.cpp";
}else if($_POST['code-lang']=="Java"){
    $_SESSION['file']="Main.java";
}else{
    $_SESSION['file']="main.py";
}
header("Location: ../html/editor.php");
exit();
?>