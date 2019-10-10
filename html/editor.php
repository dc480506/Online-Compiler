<?php
session_start();
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title>Code Mirror</title>
<link href="https://fonts.googleapis.com/css?family=Stylish&display=swap" rel="stylesheet">
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
<script defer src="https://kit.fontawesome.com/73dadbfb7d.js"></script>
<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
  <div class="side-panel">
    <div class="side-options">
    <i class="fas fa-file-code"></i>
    <i class="fas fa-cogs"></i>
    </div>
    <p id="panel-mode">Files</p>
    <div id="settings-options">
    <div id="theme">
      <div class="toggle-btn">
        <div class="circle"></div>
      </div>
    </div>
    <div id="layout">
        <div class="toggle-btn">
        <div class="circle"></div>
      </div>
    </div>
    </div>
  </div>
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
      <form action="../include/savecode.php" method="POST">
      <div id="rename-box">
         <input type=text name="rename-value">
         <i class="fas fa-check"></i>
      </div>
      </form>
      <div id="lang">
        <img src="../img/<?php echo $_SESSION['language']?>.jpg" id="lang-img">
        <span><pre> <?php echo $_SESSION['language']?></pre>
        </span>
      </div>
      <button type="button" id="cancel">Cancel</button>
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
      <div class="execute">
      <i class="fas fa-play"></i>
      <!--<form action="editor.php" method="GET">
      <input id="run" type="submit" name="runcode" value="run">
      </form>-->
      <input id="run" type="button" name="runcode" value="run" onclick="executeCode('<?php echo $_SESSION['u_user'].'/'.$_SESSION['code']?>','<?php echo $_SESSION['language']?>')">
    </div>
    </div> 
    <!-- Remove in future changes
    <form action="../include/savecode.php" method="POST">
    <div class="save">
        <i class="fas fa-save"></i>
        <input id="save-program" type="submit" name="save" value="save">
      </div>
    <textarea id='demotext' name="code"><?php //echo file_get_contents($_SESSION['dir']."/".$_SESSION['file']);?></textarea>
    </form>-->
    <div class="status-bar">
      <span id="file-name"><?php echo $_SESSION['file']?></span>
      <i class="fas fa-save"></i>
      <i class="fas fa-history"></i>
      <div class="file-status-container">
      <span id="file-status">saved</span>
      </div>
    </div>
    <textarea id='demotext' name="code"><?php echo file_get_contents($_SESSION['dir']."/".$_SESSION['file']);?></textarea>
    <div id="resize"></div>
    <div id="output">
      <i class="fas fa-backspace"></i>
      <textarea readonly="readonly" id="output-screen"></textarea>
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
    saveCode('<?php echo $_SESSION['u_user'].'/'.$_SESSION['code'].'/'.$_SESSION['file']?>');
  });
  </script>
  <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>


<?php
  /* session_start();
   function compile(){
    $cwd= getcwd();
    chdir($_SESSION['dir']);
    if($_SESSION['language']=="Java"){
      if(file_exists("Main.class"))
        unlink("Main.class");
      echo shell_exec("javac Main.java 2>&1");
    //echo shell_exec("java Main");
   }else if($_SESSION['language']=="C"){
      if(file_exists("a.exe"))
        unlink("a.exe");
      echo shell_exec("gcc main.c 2>&1");
    //echo shell_exec("a");
   }else{
     if(file_exists("a.exe"))
        unlink("a.exe");
     echo shell_exec("g++ main.cpp 2>&1");
   }
   chdir($cwd);
  }
*/?>