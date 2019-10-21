<?php
// descriptor array
include "config.php";
$json = file_get_contents('php://input');
$jsonArray=json_decode($json,true);
$wd=$base_dir.$jsonArray['code_path'];
$lang=$jsonArray['lang'];
chdir($wd);
$desc = array(
    0 => array('file', 'input.txt','r'),
    1 => array('pipe', 'w'), 
    2 => array('pipe', 'w')
);
$cmd = "java Main";
$proc = proc_open($cmd, $desc, $pipes);
stream_set_blocking($pipes[1], 0);
stream_set_blocking($pipes[2], 0);
//stream_set_blocking($pipes[0], 0);
if($proc === FALSE){
    throw new Exception('Cannot execute child process');
}
$status=proc_get_status($proc);
$pid = $status['pid'];

while(true) {
    $status = proc_get_status($proc);
    if($status === FALSE) {
        throw new Exception ("Failed to obtain status information for $pid");
    }
    if($status['running'] === FALSE) {
        $exitcode = $status['exitcode'];
        $pid = -1;
        echo "child exited with code: $exitcode\n";
        exit($exitcode);
    }

    // read from childs stdout and stderr
    // avoid *forever* blocking through using a time out (50000usec)
    $a=0;
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
                $data = fread($pipes[$desc], 8092);
               echo $data;
               ob_flush();
               flush();
               $a=$a+1;
               //echo $a."\n";
              //fwrite(STDOUT, $data);
              //file_put_contents("out.txt",$data,FILE_APPEND | LOCK_EX);
             // shell_exec("php sendoutput.php ".$data);
            } while (strlen($data) > 0);
           // echo "Hey". $desc;
        }
    }
    /*$read = array();
    $n = stream_select($read, $write, $except, $tv, $utv);
    if($n > 0) {
        echo "Inside input stream";
        $input=10;
        fwrite($pipes[0], $input);
    }else{
        echo "Not working";
    }*/
}
?>