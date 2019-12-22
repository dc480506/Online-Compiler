<?php
include 'config.php';
session_start();
$output = '';
$user=$_SESSION['u_user'];
if(isset($_POST["query"]) && isset($_POST["lang"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $lang = mysqli_real_escape_string($conn, $_POST["lang"]);
 $query = "SELECT * FROM code_info WHERE username='$user' AND codename='$search' AND language='$lang'";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
    $output = 'fuhfuhf';
}
else{
    $output = "";
}
echo $output;
?>