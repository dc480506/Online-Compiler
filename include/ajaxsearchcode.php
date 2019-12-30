<?php
include 'config.php';
session_start();
$output = '';
$user=$_SESSION['u_user'];
// if(isset($_POST["query"]))
// {
//  $search = mysqli_real_escape_string($conn, $_POST["query"]);
//  $query = "SELECT * FROM code_info WHERE username='$user' AND codename LIKE '%$search%' order by utime DESC";
// }
// else
// {
//  $query = "SELECT * FROM code_info WHERE username='$user' order by utime DESC";
// }
// if(isset($_POST["active"]) && $_POST["active"]==1){
// 	$query = "SELECT * FROM code_info WHERE username='$user' AND star=1 order by utime DESC";
// }
// if(isset($_POST["lang"])){
// 	$lang=mysqli_real_escape_string($conn, $_POST["lang"]);
// 	$query = "SELECT * FROM code_info WHERE username='$user' AND language='$lang' order by utime DESC";
// }
if(isset($_POST["lang"]) && $_POST["lang"]=='all'){
	$query = "SELECT * FROM code_info WHERE username='$user' order by utime DESC";
}
else if(isset($_POST["active"]) && $_POST["active"]==1){		//star
	if(isset($_POST["lang"])){		//lang
		$lang=mysqli_real_escape_string($conn, $_POST["lang"]);
		if(isset($_POST["query"])){			//search
			$search = mysqli_real_escape_string($conn, $_POST["query"]);
			$query = "SELECT * FROM code_info WHERE username='$user' AND codename LIKE '%$search%' AND language='$lang' AND star=1 order by utime DESC";
			}
		else{
			$query = "SELECT * FROM code_info WHERE username='$user' AND language='$lang' AND star=1 order by utime DESC";
		}
	}
	else{
		if(isset($_POST["query"])){
			$search = mysqli_real_escape_string($conn, $_POST["query"]);
			$query = "SELECT * FROM code_info WHERE username='$user' AND codename LIKE '%$search%' AND star=1 order by utime DESC";
			}
		else{
			$query = "SELECT * FROM code_info WHERE username='$user' AND star=1 order by utime DESC";
		}
	}	
}
else{
	if(isset($_POST["lang"])){
		$lang=mysqli_real_escape_string($conn, $_POST["lang"]);
		if(isset($_POST["query"])){
			$search = mysqli_real_escape_string($conn, $_POST["query"]);
			$query = "SELECT * FROM code_info WHERE username='$user' AND codename LIKE '%$search%' AND language='$lang' order by utime DESC";
			}
		else{
			$query = "SELECT * FROM code_info WHERE username='$user' AND language='$lang' order by utime DESC";
		}
	}
	else{
		if(isset($_POST["query"])){
			$search = mysqli_real_escape_string($conn, $_POST["query"]);
			$query = "SELECT * FROM code_info WHERE username='$user' AND codename LIKE '%$search%' order by utime DESC";
			}
		else{
			$query = "SELECT * FROM code_info WHERE username='$user' order by utime DESC";
		}
	}
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
	$output .= '
	<figure class="code-sample">
	<form method="POST" action="../include/open_code.php">
	
	';
		//for color of star
		if($row["star"]==1){
			$output.='
			<input class="star" type="checkbox" value='.$row["codename"].' name='.$row["language"].'>
			';
		}
		else{
			$output .='
			<input class="star" type="checkbox" value='.$row["codename"].' checked name='.$row["language"].'>
			';	
		}
	$output.='
	
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
		<button class="btn btn-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fas fa-ellipsis-v"></i>
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<input class="dropdown-item" type="submit" value="Download" name="dwd_btn">
				<button class="dropdown-item r-btn" name='.$row["codename"].' value='.$row["language"].' type="button">Rename</button>
				<input class="dropdown-item" type="submit" value="Delete" name="del_btn">
			</div>
	</div>
	</form>
	</figure>
	<script>
		var codename=document.getElementById("code-name");// input tag inside renamebox
		var codelang=document.getElementById("code-lang");// input tag inside renamebox
		var rename_btn=document.querySelectorAll(".r-btn");// rename button inside form tag
		var showRename=function() {
			document.querySelector(".rename-box").style.display = "flex";
			document.querySelector(".bg").style.opacity = "0.4";
			var a=this.getAttribute("name");// getting codename stored in button attribute name
			var b=this.getAttribute("value");// getting language stored in button attribute value
			codename.setAttribute("value",a);
			codelang.setAttribute("value",b);
		}
		for(var i=0;i< rename_btn.length;i++){
			rename_btn[i].addEventListener("click",showRename,false);
		}
		document.getElementById("close-rename").addEventListener("click",function(){
		document.querySelector(".rename-box").style.display="none";
		document.querySelector(".bg").style.opacity="1";
		},false);
	</script>
	';
 }
 echo $output;
}
else
{
 echo 'Code Not Found';
}
?>