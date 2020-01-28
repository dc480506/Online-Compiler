<?php
// descriptor array
session_start();
include "config.php";
$json = file_get_contents('php://input');
$jsonArray=json_decode($json,true);
$input=$jsonArray['inputs'];
$input.="\n";
if(isset($_SESSION['u_user'])){
    $sd=$_SESSION['dir'];
    $wd=$_SESSION['runfolder_rel'];
    $awd=$_SESSION['runfolder'];
    $lang=$_SESSION['language'];
    $code=$_SESSION['code'];
$desc = array(
 //   0 => array('file', 'input.txt','r'),
    0 => array('pipe', 'r'),
    1 => array('pipe', 'w'), 
    2 => array('pipe', 'w')
);
if($lang=="Java")
$cmd = "schroot -c bionic --directory ".$wd." -- java $code";
else if($lang=="Python")
$cmd = "schroot -c bionic --directory ".$wd." -- python3 main.py";
else if($lang=="C" || $lang=="C++")
 $cmd= "schroot -c bionic --directory ".$wd." -- stdbuf -o0 ./a.out";
$proc = proc_open($cmd, $desc, $pipes);
stream_set_blocking($pipes[1], 0);
stream_set_blocking($pipes[2], 0);
//stream_set_blocking($pipes[0], 0);
if($proc === FALSE){
    throw new Exception('Cannot execute child process');
}
$status=proc_get_status($proc);
$pid = $status['pid'];
//echo $pid;
$_SESSION['pid']=$pid;
//ob_flush();
//flush();
session_write_close();
$inputavail=true;
$curr_time=NULL;
$a=0;
fwrite($pipes[0],$input);
while(true) {
    $status = proc_get_status($proc);
    if($status === FALSE) {
        throw new Exception ("Failed to obtain status information for $pid");
    }
    // read from childs stdout and stderr
    // avoid *forever* blocking through using a time out (50000usec)
    foreach(array(1, 2) as $desc) {
        // check stdout for data
        $read = array($pipes[$desc]);
        $write = NULL;
        $except = NULL;
        $tv = 0;
        $utv = 50000;

        $n = stream_select($read, $write, $except, $tv, $utv);
        if($n > 0) {
            do {
                $data = fread($pipes[$desc], 1024);
                if(strlen($data)<1){
                break;
                }
               echo $data;
               ob_flush();
               flush();
               $status = proc_get_status($proc);
            } while (!$status['running']);
           // echo "Hey". $desc;
        }
    }
    if($status['running'] === FALSE) {
        $exitcode = $status['exitcode'];
        $pid = -1;
        fclose($pipes[0]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        echo "\nchild exited with code: $exitcode\n";
        exit($exitcode);
    }

    
}
}
?>