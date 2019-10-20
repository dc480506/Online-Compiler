<?php
include 'config.php';
session_start();
$output = '';
$user=$_SESSION['u_user'];
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM code_info WHERE username='$user' AND codename LIKE '%$search%'";
}
else
{
 $query = "SELECT * FROM code_info WHERE username='$user'";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
  <figure class="code-sample">
  <form method="POST" action="../include/open_code.php">
	  <div class= "code-name">
		 <input type="hidden" name="code-name" value='.$row["codename"]. '>
		  <a href="#" class= "code-name-link" onclick="this.parentNode.parentNode.submit(); return false;">'.$row["codename"].'</a>
	  </div>
	  <div class= "code-lang" >
		 <input type="hidden" name="code-lang" value='.$row["language"].'>
		  '.$row["language"].'
	  </div>
	  <div class= "code-time" >
		  '.$row["ctime"].'
	  </div>
	  <div class="dropdown code-options ">
		  <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  <i class="fas fa-ellipsis-v"></i>
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  <button class="dropdown-item r-btn" name='.$row["codename"].' value='.$row["language"].' type="button">Rename</button>
				  <input class="dropdown-item" type="submit" value="Delete" name="del_btn">
			  </div>
	  </div>
  </form>
  </figure>
  ';
 }
 echo $output;
}
else
{
 echo 'Code Not Found';
}

?>