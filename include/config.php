<?php
$host="localhost";
$uname="root";
$pwd="";
$dbname="online-compiler";
$conn = mysqli_connect($host, $uname, $pwd,$dbname);
//$base_dir="/home/devu/UserCodes/";
$base_dir="/var/UserCodes/";
$CLIENT_ID="444425785443-5mh44gn88jrf46t217t7i4m62r4ui1ro.apps.googleusercontent.com";
$google_api_path="/var/google-api-php-client-2.4.0/";
//$rundir="/var/runfolder/"     ...Original
//Added 
$rundir="/var/chroot/bionic/var/runfolder/";
$rundir_rel="/var/runfolder/";
?>
