<?php

if(isset($_POST['signup_btn'])){
    include_once 'config.php';

    $user=mysqli_real_escape_string($conn,$_POST['user']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);

    //error handlers
    //check for empty fields
    if(empty($user) || empty($email) || empty($pass) ){
        header("Location: ../index.php?signup=empty");
        exit();
    }else{
        //check if input data is not repeated (username , email)
        $sql1="SELECT * FROM user_details WHERE username='$user'";
        $sql2="SELECT * FROM user_details WHERE email='$email'";
        $result1=mysqli_query($conn,$sql1);
        $result2=mysqli_query($conn,$sql2);
        if(mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0){
            header("Location: ../index.php?signup=username_or_email_taken");
            exit();
        }else{
            //hasing the password
            $hashedpwd = password_hash($pass,PASSWORD_DEFAULT);
            //insert the user into database
            $sql1="INSERT INTO user_details (username,email,password) VALUES ('$user','$email','$hashedpwd');";
            mysqli_query($conn,$sql1);
            header("Location: ../index.php?signup=Sucess!!!!!");
            exit();
        }
    }

}else{
    header("Location: ../index.php");
    exit();
}

?>