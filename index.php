<?php
session_start();
  if(isset($_SESSION['u_user'])){
	header("Location: html/add.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>KJSCE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/def2.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-icons/css/all.css">

	

	<!--	<link rel="stylesheet" type="text/css" href="style.css">-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<meta charset = "utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">


		<meta name="google-signin-client_id" content="<?php 
		include_once 'include/config.php';
		echo $CLIENT_ID;  
		?>">

		<!--Enter yout OAuth Client ID in the content tag -->

		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


		<script type="text/javascript">
        function onSignIn(googleUser){
			var profile = googleUser.getBasicProfile();
			var email=profile.getEmail();
			var id_token = googleUser.getAuthResponse().id_token;
			googleUser.disconnect();
			if(email.includes("somaiya.edu")){
				theForm = document.createElement('form');
		 	    theForm.action = 'include/homepage.php';	//enter the page url you want to redirect the index page to after sign in
				theForm.method = 'post';
				newInput = document.createElement('input');
		 	    newInput.type = 'hidden';
		 	    newInput.name = 'idtoken';
			    newInput.value = id_token;
				theForm.appendChild(newInput);
				document.getElementById('hidden_form_container').appendChild(theForm);
		     	theForm.submit();
			}else{
				window.location.href="index.php";
		 		alert("Please login using Somaiya Mail ID");
			}
		}

			function signOut() {
				var auth2 = gapi.auth2.getAuthInstance();
				auth2.signOut().then(function () {
				alert('User signed out.');
				});
			}

		</script>
</head>
<body>
	<div class="my-main">
		<div class="bg-layer">
			<h1>KJSCE</h1>

			<div class="header-main">
			<div class="main-icon">
				<span class="fa fa-user"></span>
				
			</div>
			<div class="header-left-bottom">
				<form action="include/login_process.php" method="post">
					<div class="icon1">
						<span class="fa fa-user"></span>
						<input type="text" placeholder="Username" name="user" required="">
						
					</div>
					<div class="icon1">
						<span class="fa fa-lock"></span>
						<input type="password" placeholder="Password" name="pass" required="">
						
					</div>
					<div class="login-check">
						<label class="checkbox">
							<input type="checkbox" name="checkbox" checked="">
							<i></i>
							Keep me Log in
						</label>
						
					</div>
					<div class="bottom">
						<button class=btn name="login_btn" type="submit">Log In</button>
						
					</div>
					
				</form>

   
				
			</div>
			<div class="social">
				<ul>
					<h4>--------or connect with--------</h4>
					<!-- <li> -->
					<div class="g-signin2" data-onsuccess="onSignIn" align="middle">
						<!-- <a href="#" class="google">
							<span class="fab fa-google"></span>
						</a> -->
						</div>
					<!-- </li> -->
				</ul>
				
			</div>

				 <!--	Google Signin Code  -->
				<!--	<div id="wrapper">
					  <div class="loginbox" id="myform" >						
						<form method="post" action="#" class="popup">
							
							<div class="col-md-12 text-center">
		        				<p style="color: #44a0b3;font-size: 22px"> OR </p>
		        			</div>
							<div class="g-signin2" data-onsuccess="onSignIn" align="middle"></div>			
							
						</form>
					  </div>
					</div>-->
		         <!--	Google Signin Code End  -->

			<div class="animated-text">
            <div class="line">GET</div>
            <div class="line">READY</div>
            <div class="line">FOR</div>
            <div class="line">CODING</div>
        </div>
        <hr>
        <h4>“ Code is like humor. When you have to explain it, it’s bad.” </h4>
        <hr>

			
		
		
	</div>
	</div>


<?php
if (isset($_GET['error']))
	{
		if($_GET['error']=='notfound')
		{
			?>
		    <script type="text/javascript">
			$(document).ready(function(){
		    	document.getElementById("signin-error").innerHTML="There is an error in the input email or password.";
		        $('#myModal').modal('show');
		    });
		    </script>
			<?php 
		}
		else if($_GET['error']=='notfound1')
		{
			?>
		    <script type="text/javascript">
			  window.location.href="http://localhost/dd/index.php";
              alert("You are not authorised user. Please try again! or Contact Administrator");
		    </script>
			<?php 
		}
	}
?>
<div id="hidden_form_container" style="display:none;"></div>
</body>
</html>