<?php


session_start();

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      <title>LOGIN</title>
      <link rel="stylesheet" type="text/css" href="css/def.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
   </head>
   <body>
      <div class="login">
         <div id="slider">
            <div id="loginslider">
               <form action="include/login_process.php" method="POST">
                  <h1>Login</h1>
                  <div class="txtb">
                     <input type="text" name="user" required="required">
                     <span dataplaceholder="Username"></span>
                  </div>
                  <div class="txtb">
                     <input type="password" name="pass" required="required">
                     <span dataplaceholder="Password"></span>
                  </div>
                  <p class="keeplogin"> 
                     <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                     <label for="loginkeeping">Keep me log in</label>
                  </p>
                  <input type="submit" class="logbtn" value="Log In" name="login_btn">
                  <div class="bottom">
                     Don't have account? <a id="signup" href="#">Sign up </a>
                  </div>
               </form>
            </div>
            <div id="signupslider">
               <form action="include/signup_process.php" method="POST">
                  <h1>Sign Up</h1>
                  <div class="txtb">
                     <input type="text" required="required" name="user">
                     <span dataplaceholder="Username"></span>
                  </div>
                  <div class="txtb">
                     <input type="email" required="required" name="email">
                     <span dataplaceholder="Email"></span>
                  </div>
                  <div class="txtb">
                     <input type="password" required="required" name="pass">
                     <span dataplaceholder="Password"></span>
                  </div>
                  <input type="submit" class="logbtn" value="Create Account" name="signup_btn">
                  <div class="bottom">
                     Already have an account? <a id="signin" href="#">Log In </a>
                  </div>
               </form>
            </div>
         </div>
         <div class="animated-text">
            <div class="line">GET</div>
            <div class="line">READY</div>
            <div class="line">FOR</div>
            <div class="line">CODING</div>
         </div>
         <h5>--------or connect with--------</h5>
         <div class="middle">
            <a class="btn" href="#">
            <i class="fab fa-facebook-f"></i>
            </a>
            <a class="btn" href="#">
            <i class="fab fa-twitter"></i>
            </a>
            <a class="btn" href="#">
            <i class="fab fa-google"></i>
            </a>
         </div>
      </div>
      <div class="container1">
         <div class="slidershow middle1">
            <h4>“ Code is like humor. When you have to explain it, it’s bad.” </h4>
            <div class="slides">
               <input type="radio" name="r" id="r1" checked>
               <input type="radio" name="r" id="r2">
               <input type="radio" name="r" id="r3">
               <input type="radio" name="r" id="r4">
               <input type="radio" name="r" id="r5">
               <div class="slide s1">
                  <img src="img/imzge2.jpg" alt="">
               </div>
               <div class=slide>
                  <img src="img/images.jpg" alt="">
               </div>
               <div class=slide>
                  <img src="img/image3.jpg" alt="">
               </div>
               <div class=slide>
                  <img src="img/image4.jpg" alt="">
               </div>
               <div class=slide>
                  <img src="img/image6.jpg" alt="">
               </div>
            </div>
            <div class="navigation">
               <label for="r1" class="bar"></label>
               <label for="r2" class="bar"></label>
               <label for="r3" class="bar"></label>
               <label for="r4" class="bar"></label>
               <label for="r5" class="bar"></label>
            </div>
         </div>
      </div>
      <script type="text/javascript">
         $(".txtb input").on("focus",function(){
           $(this).addClass("focus");
         });
         
         $(".txtb input").on("blur",function(){
           if($(this).val() == "")
           $(this).removeClass("focus");
         });
         
      </script>
      <script type="text/javascript" src="js/def.js"></script>>
   </body>
</html>