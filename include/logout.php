<?php

session_start();
if(isset($_SESSION['runfolder'])){
    $dir=$_SESSION['runfolder'];
    array_map('unlink', glob($dir."/*.*"));
    rmdir($dir);
}
session_unset();
session_destroy();
header("Location: ../index.php");
exit();

?>
