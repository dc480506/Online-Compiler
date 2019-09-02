<?php

session_start();
if(isset($_POST['add_btn'])){
    include_once 'config.php';

    $user=$_SESSION['u_user'];
    $lang=mysqli_real_escape_string($conn,$_POST['language']);
    $cname=mysqli_real_escape_string($conn,$_POST['codename']);
    $ctime=$utime= date('m/d/Y h:i:s a', time());


    //error handlers
    //check for empty fields
    if(empty($lang) || empty($cname) ){
        header("Location: ../index.php?login=empty");
        exit();
    }else{
        //check if input data is not repeated (username , code name)
        $sql="SELECT * FROM user_details WHERE username='$user' and codename='$cname'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0 ){
            header("Location: ../index.php?signup=code_already_exists");
            exit();
        }else{
            //insert the code_info into database
            $sql="INSERT INTO user_details (username,codename,language,ctime,utime) VALUES ('$user','$cname','$lang','$ctime','$utime');";
            mysqli_query($conn,$sql);
            header("Location: ../index.php?add_code=Sucess!!!!!");
            exit();
			}
        }
    }

}else{
    header("Location: ../index.php");
    exit();
}


?>