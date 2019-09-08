<?php

session_start();

if(isset($_POST['login_btn'])){
    include_once 'config.php';

    $user=mysqli_real_escape_string($conn,$_POST['user']);
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);

    //error handlers
    //check for empty fields
    if(empty($user) || empty($pass) ){
        header("Location: ../index.php?login=empty");
        exit();
    }else{
        //check if input data is present (username )
        $sql="SELECT * FROM user_details WHERE username='$user'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) < 1){
            header("Location: ../index.php?login=error");
            exit();
        }else{
            if($row= mysqli_fetch_assoc($result)){
				//de-hashin password
				$hashedPwdCheck=password_verify($pass,$row['password']);
				if($hashedPwdCheck == false){
					header("Location: ../index.php?login=error");
            		exit();
				}elseif($hashedPwdCheck == true){
					//login the user here
					$_SESSION['u_user']=$row['username'];
					header("Location: ../html/add.php?login=Sucess!!!!!");
            		exit();

				}
			}
        }
    }

}else{
    header("Location: ../index.php");
    exit();
}

?>