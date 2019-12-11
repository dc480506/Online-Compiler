<?php
include 'config.php';
session_start();
$output = '';
$user=$_SESSION['u_user'];
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM code_info WHERE username='$user' AND codename='$search'";
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