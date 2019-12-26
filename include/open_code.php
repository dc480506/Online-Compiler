<?php
session_start();
include "config.php";
$_SESSION['dir']=$base_dir.$_SESSION['u_user']."/".$_POST['code-lang']."/".$_POST['code-name'];
$_SESSION['file']="";
$_SESSION['language']=$_POST['code-lang'];
$_SESSION['code']=$_POST['code-name'];
$user=$_SESSION['u_user'];
$code=$_SESSION['code'];
$dir=$_SESSION['dir'];
$lang=$_SESSION['language'];
if(isset($_POST['del_btn'])){
    $sql="DELETE FROM code_info WHERE username='$user' AND codename='$code' AND language='$lang';";
    mysqli_query($conn,$sql);
    array_map('unlink', glob("$dir/*.*"));
    rmdir($dir);
    header("Location: ../html/add.php?code_deleted");
    exit();
}
else if(isset($_POST['rename_btn'])){
    $u1=mysqli_real_escape_string($conn,$_POST['rename']);
    $sql="UPDATE code_info SET codename='$u1' WHERE username='$user' AND codename='$code'  AND language='$lang';";
    mysqli_query($conn,$sql);
    $new=$base_dir.$_SESSION['u_user']."/".$lang."/".$u1;
    rename($dir,$new);
    header("Location: ../html/add.php?renamed");
    exit();
}
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