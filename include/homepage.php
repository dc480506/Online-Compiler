<?php

session_start();
echo "Login to homepage";
$_SESSION['user']=$_POST['user'];  //retrieving posted values
$_SESSION['email']=$_POST['email'];
?>

<!DOCTYPE html>
<html>
<head>
		<title>GoogleSigninExample</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<meta charset = "utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">


	<meta name="google-signin-client_id" content="444425785443-5mh44gn88jrf46t217t7i4m62r4ui1ro.apps.googleusercontent.com">
	<!--Enter yout OAuth Client ID in the content attribute -->

	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


	<script type="text/javascript">
	
	
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      alert('User signed out.');
      document.location.href = '../index.php';

    });
  }
   function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
        
      });
    }

	</script>
	<title>homepage</title>
</head>
<body>
      <img src="#" id="pic" align="center">
      <script type="text/javascript">
        document.getElementById("pic").src=<?php echo json_encode($_SESSION['pic']); ?>;	//displaying user pic
      </script>
      <p id="name">nv</p>
      <script type="text/javascript">
        document.getElementById("name").innerHTML=<?php echo json_encode($_SESSION['user']); ?>; //displaying user name
      </script>
      <p id="email">nv</p>
      <script type="text/javascript">
        document.getElementById("email").innerHTML=<?php echo json_encode($_SESSION['email']); ?>; //displaying user email
      </script>
      <button onclick="signOut()">Sign Out</button>
       <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

</body>
</html>

<?php
include_once 'config.php';
$query="SELECT * FROM user_details WHERE email='".$_POST['email']."'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
    $_SESSION['u_user']=$row['username'];
    header("Location: ../html/add.php?login=Sucess!!!!!");
    exit();
}
else if(mysqli_num_rows($result) < 1){
    $p=strpos($_POST['email'],'@',0);
    $username=substr($_POST['email'],0,$p);
    $email=$_POST['email'];
    $query="INSERT INTO user_details (username,email) VALUES ('$username','$email')";
    mysqli_query($conn,$query);
    $dir=$base_dir.$username;
    mkdir($dir,0777,true);
    $_SESSION['u_user']=$username;
    header("Location: ../html/add.php?login=Sucess!!!!!");
    exit();
}  
?>