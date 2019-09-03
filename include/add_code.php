<?php

session_start();
if(isset($_POST['add_btn'])){
    include_once 'config.php';

    $user=$_SESSION['u_user'];
    $lang=mysqli_real_escape_string($conn,$_POST['language']);
    $cname=mysqli_real_escape_string($conn,$_POST['codename']);
    $ctime=$utime= date("Y-m-d H:i:s");


    //error handlers
    //check for empty fields
    if(empty($lang) || empty($cname) ){
        header("Location: ../html/add.php?login=empty");
        exit();
    }else{
        //check if input data is not repeated (username , code name)
        $sql="SELECT * FROM code_info WHERE username='$user' and codename='$cname'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0 ){
            header("Location: ../html/add.php?add_code=code_already_exists");
            exit();
        }else{
            //insert the code_info into database
            $sql="INSERT INTO code_info (username,codename,language,ctime,utime) VALUES ('$user','$cname','$lang','$ctime','$utime');";
            mysqli_query($conn,$sql);
            header("Location: ../html/add.php?add_code=Sucess!!!!!");
            exit();
			}
        }
}else{
    header("Location: ../index.php");
    exit();
}


?>