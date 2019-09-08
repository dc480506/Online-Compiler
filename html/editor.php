<?php
session_start();
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title>Code Mirror</title>
<link rel="stylesheet" type="text/css" href="../codemirror-5.48.2/lib/codemirror.css">
<link rel="stylesheet" type="text/css" href="../codemirror-5.48.2/addon/hint/show-hint.css">
<link rel="stylesheet" type="text/css" href="../codemirror-5.48.2/theme/xq-light.css">
<link rel="stylesheet" type="text/css" href="../codemirror-5.48.2/theme/xq-dark.css">
<script type="text/javascript" src="../codemirror-5.48.2/lib/codemirror.js"></script>
<?php
if($_SESSION['language']=="Python"){
  echo '<script type="text/javascript" src="../codemirror-5.48.2/mode/python/python.js"></script>';
}else{
echo '<script type="text/javascript" src="../codemirror-5.48.2/mode/clike/clike.js"></script>';
}
?>
<script type="text/javascript" src="../codemirror-5.48.2/addon/edit/matchbrackets.js"></script>
<script type="text/javascript" src="../codemirror-5.48.2/addon/edit/matchtags.js"></script>
<script type="text/javascript" src="../codemirror-5.48.2/addon/hint/show-hint.js"></script>
<script type="text/javascript" src="../codemirror-5.48.2/addon/edit/closebrackets.js"></script>
<script type="text/javascript" src="../codemirror-5.48.2/addon/edit/closetag.js"></script>
<script src="https://kit.fontawesome.com/73dadbfb7d.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <div class="menu-bar">
      <a href="../index.php">
        <i class="fas fa-laptop-code"></i>
      </a>
    <div class="code-info">
      <div id="code-name">
        <span>
        <?php echo $_SESSION['code']?>
        </span>
        <i class="fas fa-pen"></i>
      </div>
      <div id="lang"><img src="../img/<?php echo $_SESSION['language']?>.jpg" id="lang-img"><span><pre> <?php echo $_SESSION['language']?></pre></span></div>
    </div>
    <div class="execute">
      <i class="fas fa-play"></i>
      <input id="run" type="button" value="run">
    </div>
    <div class="new-code">
      <i class="fas fa-plus"></i>
      <input id="new-code" type="button" value="new code">
    </div>
      <div class="algo-search">
          <input id="search-text" type="text" placeholder="Type to Search an algorithm">
          <i class="fas fa-search"></i>
      </div>
      <div class="user-profile">
        <p><?php echo $_SESSION['u_user']?> <span><i class="fas fa-caret-down"></i></span></p>
      </div>
      <div class="user-options">
         <ul>
            <li>My Profile</li>
            <li>Change Password</li>
            <li>Log Out</li>
          </ul>
      </div>
    </div> 
    <div id="theme">
      <div class="toggle-btn">
        <div class="circle"></div>
      </div>
    </div>
    <form action="../include/savecode.php" method="POST">
    <div class="save">
        <i class="fas fa-save"></i>
        <input id="save-program" type="submit" name="save" value="save">
      </div>
    <textarea id='demotext' name="code"><?php echo file_get_contents($_SESSION['dir']."/".$_SESSION['file']);?></textarea>
    </form>
    <div id="output">
      <i class="fas fa-backspace"></i>
      <textarea id="output-screen"></textarea>
    </div>
<script type="text/javascript">
 var editor = CodeMirror.fromTextArea(document.getElementById("demotext"), {
          lineNumbers: true,
          mode:"<?php 
            if($_SESSION['language']=="C")
              echo "text/x-csrc";
            else if($_SESSION['language']=="C++")
               echo "text/x-c++src";
            else if($_SESSION['language']=="Java")
               echo "text/x-java";
            else
              echo "python";
          ?>",
          theme:"xq-dark",
          matchBrackets:true,
          autoCloseBrackets:true,
          autoCloseTags:true
  });
  editor.on('keyup', function(editor,event){
      if( !(event.ctrlKey) && 
        (event.keyCode>=65 && event.keyCode<=90)
        ||(event.keyCode>=97 && event.keyCode<=122)
        ||(event.keyCode>=46 && event.keyCode<=57)){
       editor.showHint({completeSingle:false});
    }
  });</script>
  <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>
