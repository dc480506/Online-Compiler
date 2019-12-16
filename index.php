<?php
session_start();
  if(isset($_SESSION['u_user'])){
	header("Location: ../OnlineCompiler/html/add.php");
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
					<li>
						<a href="#" class="google">
							<span class="fab fa-google"></span>
						</a>
					</li>
				</ul>
				
			</div>
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

</body>
</html>