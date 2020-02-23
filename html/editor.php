<?php
session_start();
include_once '../include/config.php';
if(!isset($_SESSION['u_user'])){
  header("Location: ../index.php");
  exit();
}
$_SESSION['prunning']=false;
if(!isset($_SESSION['runfolder'])){
  //Original section
  // $u=md5(uniqid(rand(), true));
  // $_SESSION['runfolder']=$rundir."/".$u;
  // mkdir($_SESSION['runfolder'],0777,true);
  //$u=md5(uniqid(rand(), true));
  //$u=sha1($_SESSION['u_user'].date("Y-m-d H:i:s"));
  $u=hash("sha256",$_SESSION['u_user'].date("Y-m-d H:i:s"));
  $_SESSION['runfolder']=$rundir.$u;
  mkdir($_SESSION['runfolder'],0777,true);
  $_SESSION['runfolder_rel']=$rundir_rel.$u;
}else{
  shell_exec("rm -r ".$_SESSION['runfolder']."/*");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title>Code Mirror</title>
<link href="https://fonts.googleapis.com/css?family=Stylish&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../codemirror/lib/codemirror.css">
<link rel="stylesheet" type="text/css" href="../codemirror/addon/hint/show-hint.css">
<link rel="stylesheet" type="text/css" href="../codemirror/theme/xq-light.css">
<link rel="stylesheet" type="text/css" href="../codemirror/theme/xq-dark.css">
<link rel="stylesheet" type="text/css" href="../codemirror/theme/night.css">
<link rel="stylesheet" type="text/css" href="../codemirror/theme/material-ocean.css">
<link rel="stylesheet" type="text/css" href="../codemirror/theme/ayu-mirage.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css" rel="stylesheet" />-->
<script type="text/javascript" src="../codemirror/lib/codemirror.js"></script>
<?php
if($_SESSION['language']=="Python"){
  echo '<script type="text/javascript" src="../codemirror/mode/python/python.js"></script>';
}else{
echo '<script type="text/javascript" src="../codemirror/mode/clike/clike.js"></script>';
}
?>
<script type="text/javascript" src="../codemirror/addon/edit/matchbrackets.js"></script>
<script type="text/javascript" src="../codemirror/addon/edit/matchtags.js"></script>
<script type="text/javascript" src="../codemirror/addon/hint/show-hint.js"></script>
<script type="text/javascript" src="../codemirror/addon/edit/closebrackets.js"></script>
<script type="text/javascript" src="../codemirror/addon/edit/closetag.js"></script>
<!--<script defer src="https://kit.fontawesome.com/73dadbfb7d.js"></script>-->
<link rel="stylesheet" type="text/css" href="../fontawesome-icons/css/all.min.css">
<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
  <div class="side-panel">
    <div class="side-options">
    <i class="fas fa-file-code" title="Files"></i>
    <i class="fas fa-cogs" title="Settings"></i>
    </div>
    <div id="panel-mode"><span>Files</span></div>
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
        <img src="../img/<?php echo $_SESSION['language']?>.jpg" id="lang-img" title="<?php echo $_SESSION['language']?>">
        <span><?php echo $_SESSION['code']?></span>
        <i class="fas fa-pen" title="Rename"></i>
    </div>
   <!-- <div class="new-code">
      <i class="fas fa-plus"></i>
      <input id="new-code" type="button" value="new code">
    </div>-->
    <button type="button" id="download-btn" title="Download (Ctrl+Alt+S)"><i class="fas fa-file-download"></i></button>
      <!-- <div class="algo-search">
          <input id="search-text" type="text" placeholder="Type to Search an algorithm">
          <i class="fas fa-search"></i>
      </div>  -->
      <button type="button" id="exec-mode" title="Test Case Mode"><i class="fas fa-terminal"></i></button>
     
      <div class="user-options">
						<?php
						if(isset($_SESSION['u_user'])){
							$user=$_SESSION['u_user'];
							echo '<button class="user-button btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>';
							echo $user;
							echo'</span></button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="../include/logout.php">Logout</a>
							</div>';
						}
						?>
				</div>
      <button id="execute" type="button" onclick="executeCode()" title="Run (Ctrl+Enter)">
      <i class="fas fa-play"></i><span>run</span></button>
     <!-- <form method="POST" action="../include/stop2.php">-->
    <button id="stop" type="submit" onclick="stopCode()" title="Stop (Ctrl+Shift+Enter)">
    <i class="fas fa-stop"></i><span>stop</span></button>
          <!--</form>-->
    </div> 
    <div class="rename-box">
        <span title="cancel">+</span>
        <input type="text" spellcheck="false"/>
        <button type="button"><span>Rename</span></button>
      </div>
    <div id="parent">
    <div class="status-bar">
      <span id="file-name"><?php echo $_SESSION['file']?></span>
      <div class="file-status-container">
      <i class="fas fa-save"></i>
      <i class="fas fa-history"></i>
      <span id="file-status">saved</span>
      </div>
    </div>
    <textarea id='demotext' name="code"><?php echo file_get_contents($_SESSION['dir']."/".$_SESSION['file']);?></textarea>
    <div id="output">
      <i class="fas fa-backspace"></i>
      <!--<textarea readonly="readonly" id="output-screen"></textarea>-->
      <textarea id="output-screen" readonly="readonly" spellcheck="false" onKeyPress="sendUserInput(event)" ></textarea>
    </div>
</div>
<div id="screen-container">
<div id="testcase-box" class="ui-widget-content">
 <p>Input:</p>
 <textarea id="input-text"></textarea>
</div>
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
          autoCloseTags:true,
          lineWrapping: true,
      
         
  });
  editor.on('keyup', function(editor,event){
      if( !(event.ctrlKey) &&
        (event.keyCode>=65 && event.keyCode<=90)
        ||(event.keyCode>=97 && event.keyCode<=122)
        ||(event.keyCode>=46 && event.keyCode<=57)){
       editor.showHint({completeSingle:false});
    }
    if(event.keyCode>40 || event.keyCode<37)
      saveCode();
  });
  </script>
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>-->
<link href="../jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" />
<script src="../jquery-ui-1.12.1/external/jquery/jquery.js"></script>
<script src="../jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script>
   var clayout="sidebyside";
    $("#output").resizable({containment:"#parent",handles:"w",maxWidth:0.5*$("#parent").width(),minWidth:0.25*$("#parent").width()});
$('#output').resize(function(){
   $('.CodeMirror').width($("#parent").width()-$("#output").width()-0.002*$("#parent").width()); 
   $('.status-bar').width($("#parent").width()-$("#output").width()-0.002*$("#parent").width()); 
});
/*$(".CodeMirror").resizable({handles:"s",maxHeight:0.45*$("#parent").height(),minWidth:0.2*$("#parent").height()});
$('.CodeMirror').resize(function(){
   $('#output').height($("#parent").height()-$(".CodeMirror").height()-0.005*$("#parent").height()); 
});
$('.CodeMirror').resizable('disable');*/
$( function() {
    $( "#testcase-box" ).draggable({containment: "#screen-container"});
  } );
  $(function() {
      $( "#testcase-box" ).resizable({
        containment:"#screen-container",
        maxWidth:0.5*$("#screen-container").width(),
        minWidth:0.12*$("#screen-container").width(),
        maxHeight:0.6*$("#screen-container").height(),
        minHeight:0.20*$("#screen-container").height()
      });
    });
</script>
<script>
  function download() {
    var extension='<?php 
      if($_SESSION['language']=='C'){
        echo "c";
      }else if($_SESSION['language']=='C++'){
        echo "cpp";
      }else if($_SESSION['language']=='Java'){
        echo "java";
      }else{
        echo "py";
      }
      ?>';
    var element = document.createElement('a');
    var text=editor.getValue();
    var filename=document.querySelector(".code-info>span").innerText;
    filename+="."+extension;
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}
document.querySelector("#download-btn").addEventListener("click",download);
</script>
  <script type="text/javascript" src="../js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../mousetrap/mousetrap.min.js"></script>
  <script>
   Mousetrap.bind(['command+alt+s', 'ctrl+alt+s'],download);
   Mousetrap.bind(['command+enter','ctrl+enter'],executeCode);
   Mousetrap.bind(['command+shift+enter','ctrl+shift+enter'],stopCode);
  </script>
</body>
</html>
