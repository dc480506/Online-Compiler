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
if($_POST['code-lang']=="C"){
    $_SESSION['file']="main.c";
    $filename=$code.".c";
}else if($_POST['code-lang']=="C++"){
    $_SESSION['file']="main.cpp";
    $filename=$code.".cpp";
}else if($_POST['code-lang']=="Java"){
    $_SESSION['file']=$code.".java";
    $filename=$code.".java";
}else{
    $_SESSION['file']="main.py";
    $filename=$code.".py";
}
$path=$dir."/".$_SESSION['file'];
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
else if(isset($_POST['dwd_btn'])){
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
    readfile($path);
    //echo $path;
    //header("Location: ../html/add.php?code-downloaded");
    exit();
}
header("Location: ../html/editor.php");
exit();
?>