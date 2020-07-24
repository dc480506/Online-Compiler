<?php
$host="localhost";
$uname="root";
$pwd="";
$dbname="online-compiler";
$conn = mysqli_connect($host, $uname, $pwd,$dbname);
// $base_dir="/home/devu/UserCodes/";
$base_dir="/var/UserCodes/";
$CLIENT_ID="784580307034-0ta70nlq55f8q67tb9k4q31noar2n3r1.apps.googleusercontent.com";
$google_api_path="/var/google-api-php-client-2.4.0/";
//$rundir="/var/runfolder/"     ...Original
//Added 
$rundir="/var/chroot/bionic/var/runfolder/";
$rundir_rel="/var/runfolder/";
?>
