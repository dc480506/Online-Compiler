<?php

session_start();
if(isset($_SESSION['runfolder'])){
    $dir=$_SESSION['runfolder'];
    array_map('unlink', glob($dir."/*.*"));
    rmdir($dir);
}
if(isset($_SESSION['csession'])){
    shell_exec("schroot -e -c ".$_SESSION['csession']);
}
session_unset();
session_destroy();
header("Location: ../index.php");
exit();

?>
