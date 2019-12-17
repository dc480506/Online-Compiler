<?php
session_start();
$_SESSION['prunning']=false;
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css" rel="stylesheet" />-->
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
<!--<script defer src="https://kit.fontawesome.com/73dadbfb7d.js"></script>-->
<link rel="stylesheet" type="text/css" href="../fontawesome-icons/css/all.css">
<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
  <div class="side-panel">
    <div class="side-options">
    <i class="fas fa-file-code"></i>
    <i class="fas fa-cogs"></i>
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
      <div class="algo-search">
          <input id="search-text" type="text" placeholder="Type to Search an algorithm">
          <i class="fas fa-search"></i>
      </div>
     
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
      <button id="execute" type="button" onclick="executeCode('<?php echo $_SESSION['u_user'].'/'.$_SESSION['code']?>','<?php echo $_SESSION['language']?>')">
      <i class="fas fa-play"></i><span>run</span></button>
     <!-- <form method="POST" action="../include/stop2.php">-->
    <button id="stop" type="submit" onclick="stopCode()">
    <i class="fas fa-stop"></i><span>stop</span></button>
          <!--</form>-->
    </div> 
    <div class="rename-box">
        <span title="cancel">+</span>
        <input type="text"/>
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
      <textarea id="output-screen" readonly="readonly" spellcheck="false" onKeyPress="sendUserInput(event,'<?php echo $_SESSION['u_user'].'/'.$_SESSION['code']?>')" ></textarea>
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
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>-->
<link href="../jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" />
<script src="../jquery-ui-1.12.1/external/jquery/jquery.js"></script>
<script src="../jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script>
   var clayout="sidebyside";
    $("#output").resizable({handles:"w",maxWidth:0.5*$("#parent").width(),minWidth:0.25*$("#parent").width()});
$('#output').resize(function(){
   $('.CodeMirror').width($("#parent").width()-$("#output").width()-0.002*$("#parent").width()); 
   $('.status-bar').width($("#parent").width()-$("#output").width()-0.002*$("#parent").width()); 
});
/*$(".CodeMirror").resizable({handles:"s",maxHeight:0.45*$("#parent").height(),minWidth:0.2*$("#parent").height()});
$('.CodeMirror').resize(function(){
   $('#output').height($("#parent").height()-$(".CodeMirror").height()-0.005*$("#parent").height()); 
});
$('.CodeMirror').resizable('disable');*/
</script>
  <script type="text/javascript" src="../js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
