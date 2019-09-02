<?php
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Add Codes</title>
	<link href="../css/add.css" rel="stylesheet" type="text/css" />
	<script src="https://kit.fontawesome.com/ba3c03b371.js">
	</script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
</head>

<body>
	<div class="bg">
		<div class="top-bar">
			<div class="logo">
				<a href="../index.php">
					<i class="fas fa-laptop-code"></i>
					</a>
				</div>
				<div>
					<button type="button" id="add-button"><i class="fas fa-plus"></i> add</button>
				</div>
				<div class="user-options">
						<label><?php
						if(isset($_SESSION['u_user'])){
							$user=$_SESSION['u_user'];
							echo '<button type="submit" class="user-button">';
							echo $user;
							echo'</button>';
						}
						?></label>
				    </div>   
    	</div>
		

	<div class="codes">
		<figure class="code-sample">
			<div class= "code-name" >
				<a href="" class= "code-name-link">abc</a>
			</div>
			<div class= "code-lang" >
				C
			</div>
			<div class= "code-time" >
				1 hour ago
			</div>
		</figure>

		<figure class="code-sample">
			<div class= "code-name" >
				<a href="" class= "code-name-link">ham</a>
			</div>
			<div class= "code-lang" >
				C++
			</div>
			<div class= "code-time" >
				2 hour ago
			</div>
		</figure>

		<figure class="code-sample">
			<div class= "code-name" >
				<a href="" class= "code-name-link">xya</a>
			</div>
			<div class= "code-lang" >
				Java
			</div>
			<div class= "code-time" >
				10 hour ago
			</div>
		</figure>

	</div>

	</div>	<!--bg end-->

	<div class ="create-box">
	<form action="include/add_code.php" method="POST" >
		<div id="cb-close">+</div>
		<label class="cb-heading">Create a new code</label>
		<div class="lang-box">
		<select name="language" class="clang">
    	<option value="C">C</option>
    	<option value="C++">C++</option>
    	<option value="Java">Java</option>
  	</select>
		</div>
		<input class="cname" type="text" name="codename" placeholder="Name your code">
		<input class="cb-button" type="submit" value="Create" name="add_btn">
	</form>
	</div>
	
	<script src="../js/add.js"></script>
  </body>
</html>