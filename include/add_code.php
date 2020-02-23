
<?php
session_start();
if(isset($_POST['add_btn'])){
    include_once 'config.php';
    $user=$_SESSION['u_user'];
    $lang=mysqli_real_escape_string($conn,$_POST['language']);
    $cname=mysqli_real_escape_string($conn,$_POST['codename']);
    $ctime=$utime= date("Y-m-d H:i:s");
    //error handlers
    //check for empty fields
    if(empty($lang) || empty($cname) ){
        header("Location: ../html/add.php?login=empty");
        exit();
    }else{
        //check if input data is not repeated (username , code name)
        $sql="SELECT * FROM code_info WHERE username='$user' and codename='$cname' and language='$lang'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0 ){
            header("Location: ../html/add.php?add_code=code_already_exists");
            exit();
        }else{
            //insert the code_info into database
            $sql="INSERT INTO code_info (username,codename,language,ctime,utime) VALUES ('$user','$cname','$lang','$ctime','$utime');";
            $result=mysqli_query($conn,$sql);
            $dir=$base_dir."/".$user."/".$lang."/".$cname;
            mkdir($dir,0751,true);
            //file_put_contents($dir."/input.txt","");
            if($lang=="C"){
                $_SESSION['file']="main.c";
                file_put_contents($dir."/main.c","");
            }else if($lang=="C++"){
                $_SESSION['file']="main.cpp";
                file_put_contents($dir."/main.cpp","");
            }else if($lang=="Java"){
                // $_SESSION['file']="Main.java";
                // file_put_contents($dir."/Main.java","");
                $_SESSION['file']=$cname.".java";
                $ini_code="public class ".$cname."{\n\tpublic static void main(String args[]){\n\n\t}\n}";
                file_put_contents($dir."/".$_SESSION['file'],$ini_code);
            }else if($lang=="Python"){
                $_SESSION['file']="main.py";
                file_put_contents($dir."/main.py","");
            }else{
                header("Location: ../html/add.php?add_code=Error!!!!!");
            }
            $_SESSION['language']=$lang;
            $_SESSION['code']=$cname;
            $_SESSION['dir']=$dir;
            header("Location: ../html/editor.php");
            
            exit();
			}
        }
}else{
    header("Location: ../index.php");
    exit();
}
?>