<?php
    include 'config.php';
	//get values from login.php
	$username=$_POST['user'];
	$password=$_POST['pass'];
	
	//to prevent mysql injection
	/*$username=stripslashes($username);
	$password=stripslashes($password);*/
	$username=mysqli_real_escape_string($conn,$username);
	$password=mysqli_real_escape_string($conn,$password);
	
	//connect to the server and select database
	//mysql_select_db("login");
	
	//Query the database for user
	$result=mysqli_query($conn,"select * from login_details where username='$username' and pwd='$password'")
				or die("Failed to query database ".mysql_error());
	$row=mysqli_fetch_array($result);
	
	if($row['username'] == $username && $row['pwd'] == $password ){
		echo "Login Success !! Welcome ".$row['username'];
	   session_start();
	   $_SESSION['logged']=true;
	   $_SESSION['username']=$username;
	   header("refresh:3;url=../html/add.php");
	   
	}else
		echo "Failed to login......";
?>