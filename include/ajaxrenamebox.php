<?php
include 'config.php';
session_start();
$user=$_SESSION['u_user'];
$codename=$_SESSION['code'];
$lang=$_SESSION['language'];
$dir=$_SESSION['dir'];
$file=$_SESSION['file'];
$json = file_get_contents('php://input');
$jsonArray=json_decode($json,true);
$newname=$jsonArray['newname'];
$op=$jsonArray['op'];
$newname=mysqli_real_escape_string($conn, $newname);
if($op==1){
    if($newname==""){
        echo 'fuhfuhf';
    }else{
    $query="SELECT * FROM code_info WHERE username='$user' AND codename='$newname' AND language='$lang'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $output = 'fuhfuhf';
    }
    else{
        $output = "";
    }
    echo $output;
    }
}else{
    $query="UPDATE code_info SET codename='$newname' WHERE username='$user' AND codename='$codename' AND language='$lang'";
    mysqli_query($conn, $query);
    $new=$base_dir.$user."/".$lang."/".$newname;
    rename($dir,$new);
    if($lang=="Java"){
     $newfile=$newname.".java";   
     rename($new."/".$file,$new."/".$newfile);
     $_SESSION['file']=$newfile;  
     echo "Java"; 
    }
    $_SESSION['code']=$newname;
    $_SESSION['dir']=$new;
}
?>