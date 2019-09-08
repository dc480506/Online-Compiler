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
						<?php
						if(isset($_SESSION['u_user'])){
							$user=$_SESSION['u_user'];
							echo '<select class="user-button" onchange="location = this.value;"><option value="" selected disabled hidden><span>';
							echo $user;
							echo'</span><i class="fas fa-caret-down" style="margin-left:5px"></i></option>
							<option value="../include/logout.php">Logout</a></option>
							</select>';
						}
						?>
				</div>   
    	</div>
		

	<div class="codes">
	<?php

		include_once '../include/config.php';


		$sql="SELECT * FROM code_info WHERE username='$user'";
		$result=mysqli_query($conn,$sql);
		
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				echo'
				<figure class="code-sample">
				<form method="POST" action="../include/open_code.php">
					<div class= "code-name">
					   <input type="hidden" name="code-name" value='.$row["codename"].'>
						<a href="#" class= "code-name-link" onclick="this.parentNode.parentNode.submit(); return false;">'.$row["codename"].'</a>
					</div>
					<div class= "code-lang" >
					   <input type="hidden" name="code-lang" value='.$row["language"].'>
						'.$row["language"].'
					</div>
					<div class= "code-time" >
						'.$row["ctime"].'
					</div>
					<div class="code-options">
					</div>
				</form>
				</figure>';
			}
		}
		


		// <figure class="code-sample">
		// 	<div class= "code-name" >
		// 		<a href="" class= "code-name-link">abc</a>
		// 	</div>
		// 	<div class= "code-lang" >
		// 		C
		// 	</div>
		// 	<div class= "code-time" >
		// 		1 hour ago
		// 	</div>
		// 	<div class="code-options">

		// 	</div>
		// </figure>

		?>
		
		
	</div>

	

	</div>	<!--bg end-->

	<div class ="create-box">
	<form action="../include/add_code.php" method="POST" >
		<div id="cb-close">+</div>
		<label class="cb-heading">Create a new code</label>
		<div class="lang-box">
		<select name="language" class="clang">
    		<option value="C">C</option>
    		<option value="C++">C++</option>
			<option value="Java">Java</option>
			<option value="Python">Python</option>
  		</select>
		</div>
		<input class="cname" type="text" name="codename" placeholder="Name your code">
		<input class="cb-button" type="submit" value="Create" name="add_btn">
	</form>
	</div>
	
	<script src="../js/add.js"></script>
  </body>
</html>