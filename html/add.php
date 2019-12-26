<?php
  session_start();
  if(!isset($_SESSION['u_user'])){
	  header("Location: ../index.php");
	  exit();
  }
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
	<title>Add Codes</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="../css/add.css" rel="stylesheet" type="text/css" />
	<script src="https://kit.fontawesome.com/ba3c03b371.js">
	</script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
							echo '<button class="user-button btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>';
							echo $user;
							echo'</span></button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="../include/logout.php">Logout</a>
							</div>';
						}
						?>
				</div>   
    	</div>
		

	<div class="middle-bar">
		<div class="star-toggle">
			<style>
				.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
				.toggle.ios .toggle-handle { border-radius: 20px; }
			</style>
			<input type="checkbox" data-toggle="toggle" data-style="ios" class="starred">
		</div>
		<div class="search-container">
			<i class="fas fa-search"></i>
			<input id="search-bar" type='text' placeholder="Search code">
		</div>
		<div class="lang-box-1">
			<select name="language" class="sel-lang">
				<option value="all">All</option>
				<option value="C">C</option>
				<option value="C++">C++</option>
				<option value="Java">Java</option>
				<option value="Python">Python</option>
			</select>
		</div>
	</div>

	<div class="codes">
	 
	 
	 	<!-- <?php
		include_once '../include/config.php';
		$sql="SELECT * FROM code_info WHERE username='$user' order by utime DESC";
		$result=mysqli_query($conn,$sql);
		
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				echo'
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
		}
		?>  -->
		
		
	</div>

	

	</div>	<!--bg end-->

	<div class ="create-box">
	<form action="../include/add_code.php" method="POST" >
		<i class="far fa-window-close"></i>
		<label class="cb-heading">Create a new code</label>
		<div class="lang-box">
			<select name="language" class="clang">
				<option value="C">C</option>
				<option value="C++">C++</option>
				<option value="Java">Java</option>
				<option value="Python">Python</option>
			</select>
		</div>
		<div class="cname-div">
			<input class="cname" type="text" name="codename" placeholder="Name your code">
			<div class="xyz"><i class="fas fa-exclamation-circle"></i></div>
		</div>
		<input class="cb-button btn" type="submit" value="Create" name="add_btn">
	</form>
	</div>
	<div class ="rename-box">
		<form action="../include/open_code.php" method="POST">
		<input type="hidden" name="code-name" value="" id="code-name">
		<input type="hidden" name="code-lang" value="" id="code-lang">
	    <i class="far fa-window-close re" id="close-rename"></i>
	    <label class="cb-heading">Rename code</label>
	    <input class="rname" type="text" placeholder="Rename your code" name="rename">
		<input class="r-button btn" type="submit" value="Rename" name="rename_btn">
		</form>
	</div>
	<script src="../js/add.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  </body>
</html>

<script>
$(document).ready(function(){
 load_data();
 function load_data(query)
 {
  $.ajax({
   url:"../include/ajaxsearchcode.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
	//console.log(data);
    $('.codes').html(data);
   }
  });
 }
 $('#search-bar').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
$(document).ready(function(){
 create_code();
 function create_code(query,lang)
 {
	console.log(lang);	
  $.ajax({
   url:"../include/ajaxcreatecode.php",
   method:"POST",
   data:{
	   query:query,
	   lang:lang
	   },
   success:function(data)
   {
	//console.log(data);
	if(data!=""){
		document.querySelector('.xyz').style.color="red";
		$(".cb-button").hide();
		//$(".cb-button").attr("disabled", true);
		//console.log('add');
	}
	else{
		document.querySelector('.xyz').style.color="#28c3d4";
		$(".cb-button").show();
		//$(".cb-button").attr("disabled", false);
		//console.log('remove');
	}
   }
  });
 }
 $('.cname').keyup(function(){
  var search = $(this).val();
  var lang = $('.clang').find(':selected')[0].value;
  if(search != '')
  {
   create_code(search,lang);
  }
  else
  {
   create_code();
  }
 });
});
//star
$(document).on("change", "input[class='star']", function () {
// store the values from the form checkbox box, then send via ajax below
var check_active = $(this).is(':checked') ? 0 : 1;
var check_id = $(this).attr('value');
var lang = $(this).attr('name');
// console.log(check_id);
// console.log(lang);
    $.ajax({
        type: "POST",
        url: "../include/ajaxstar.php",
        data: {id: check_id, active: check_active,lang:lang},
        success: function(data){
            //$('form#submit').hide(function(){$('div.success').fadeIn();});
			//alert(data);
			//console.log(data);
        }
    });
//return true;
});
$(document).on("change", "input[class='starred']", function () {
// store the values from the form checkbox box, then send via ajax below
var check_active = $(this).is(':checked') ? 1 : 0;
//console.log(check_active);
// console.log(check_id);
    $.ajax({
        type: "POST",
        url: "../include/ajaxsearchcode.php",
        data: { active: check_active},
        success: function(data){
            //$('form#submit').hide(function(){$('div.success').fadeIn();});
			//alert(data);
			//console.log(data);
			$('.codes').html(data);
        }
    });
//return true;
});
$('.sel-lang').change(function () {
    var lang = $(this).find(':selected')[0].value;
    //alert(id); 
    $.ajax({
        type: 'POST',
        url: '../include/ajaxsearchcode.php',
        data: {
            'lang': lang
        },
        success: function (data) {
            console.log(data);
			$('.codes').html(data);
        }
    });
});
</script>