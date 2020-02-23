<?php
include_once 'config.php';
require_once $google_api_path.'vendor/autoload.php';
$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
$id_token=$_POST['idtoken'];
$payload = $client->verifyIdToken($id_token);
if ($payload) {
  session_start();
  $_SESSION['email']=$payload['email'];
  $query="SELECT * FROM user_details WHERE email='".$_SESSION['email']."'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
    $_SESSION['u_user']=$row['username'];
    header("Location: ../html/add.php?login=Sucess!!!!!");
    exit();
}
else if(mysqli_num_rows($result) < 1){
    $p=strpos($_SESSION['email'],'@',0);
    $username=substr($_SESSION['email'],0,$p);
    $email=$_SESSION['email'];
    $query="INSERT INTO user_details (username,email) VALUES ('$username','$email')";
    mysqli_query($conn,$query);
    $dir=$base_dir.$username;
    mkdir($dir,0777,true);
    $_SESSION['u_user']=$username;
    header("Location: ../html/add.php?login=Sucess!!!!!");
    exit();
}  
} else {
  // Invalid ID token
}
?>