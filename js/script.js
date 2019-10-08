document.querySelector(".fas.fa-cogs").addEventListener("click",function(){
  document.getElementById("settings-options").style.display="flex";
  document.getElementById("panel-mode").innerHTML="Settings";
})
document.querySelector(".fas.fa-file-code").addEventListener("click",function(){
  document.getElementById("settings-options").style.display="none";
  document.getElementById("panel-mode").innerHTML="Files";
})
document.getElementById("theme").addEventListener("click",function(){
  if(editor.options.theme=="xq-dark"){
     editor.setOption("theme","xq-light");
     document.getElementsByClassName("toggle-btn")[0].style.backgroundColor="#3498db";
     document.getElementsByClassName("circle")[0].style.transform="translateX(115%)";
    }else{
      editor.setOption("theme","xq-dark");
      document.getElementsByClassName("toggle-btn")[0].style.backgroundColor="gray";
      document.getElementsByClassName("circle")[0].style.transform="translateX(0%)";
    }
})
var clayout="sidebyside"
document.getElementById("layout").addEventListener("click",function(){
  if(clayout=="sidebyside"){
    clayout="topdown"
     document.querySelector('.status-bar').style.width="90%";
     document.querySelector('.CodeMirror').style.width="90%"
     document.querySelector('.CodeMirror').style.height="45%"
     document.querySelector('#resize').style.height="0.8%"
     document.querySelector('#resize').style.top="60%"
     document.querySelector('#resize').style.width="90%"
     document.querySelector('#resize').style.cursor="ns-resize"
     document.querySelector('#resize').style.left="10%"
     document.querySelector('#output').style.top="60.8%"
     document.querySelector('#output').style.width="90%"
     document.querySelector('#output').style.height="39.2%"
     document.getElementsByClassName("toggle-btn")[1].style.backgroundColor="#3498db";
     document.getElementsByClassName("circle")[1].style.transform="translateX(115%)";
  }else{
      clayout="sidebyside"
      document.querySelector('.status-bar').style.width="60%";
      document.querySelector('.CodeMirror').style.width="60%"
      document.querySelector('.CodeMirror').style.height="85%"
      document.querySelector('#resize').style.height="90%"
      document.querySelector('#resize').style.top="10%"
      document.querySelector('#resize').style.width="0.2%"
      document.querySelector('#resize').style.cursor="ew-resize"
      document.querySelector('#resize').style.left="70%"
      document.querySelector('#output').style.top="10%"
      document.querySelector('#output').style.width="29.8%"
      document.querySelector('#output').style.height="90%"
      document.getElementsByClassName("toggle-btn")[1].style.backgroundColor="gray";
      document.getElementsByClassName("circle")[1].style.transform="translateX(0%)";
    }
})
var u=document.querySelector(".user-options");
document.querySelector(".fas.fa-caret-down").addEventListener("click",function(){
  if(u.style.display=="none"){
  u.style.display="block";
}else{
  u.style.display="none";
}
})
document.querySelector(".fas.fa-backspace").addEventListener("click",function(){
  document.getElementById("output-screen").value="";
})

document.querySelector(".fas.fa-pen").addEventListener("click",function(){
  document.querySelector("#rename-box").style.display="flex";
  document.querySelector("#cancel").style.display="flex";
  document.querySelector("#code-name").style.display="none";
})

document.querySelector("#cancel").addEventListener("click",function(){
  document.querySelector("#rename-box").style.display="none";
  document.querySelector("#cancel").style.display="none";
  document.querySelector("#code-name").style.display="flex";
})

//AJAX section
function saveCode(file){
  console.log("Called");
  var codetext=editor.getValue();
  console.log(codetext);
  console.log(file);
  document.querySelector(".fas.fa-save").style.display="none";
  document.querySelector(".fas.fa-history").style.display="flex";
  document.querySelector("#file-status").innerHTML="saving...";
  var jsonData={
    'file':file,
    'codetext':codetext
  };
  var jsonString=JSON.stringify(jsonData);
  var xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.querySelector(".fas.fa-history").style.display="none";
      document.querySelector(".fas.fa-save").style.display="flex";
      document.querySelector("#file-status").innerHTML="saved";
    }
  }
  xhttp.open("POST","../include/ajaxsavecode.php",true);
 // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
 xhttp.send(jsonString);
  //xhttp.send("file="+file+"&code="+codetext);
}

function executeCode(code_path,lang){
  console.log("Called 2");
  console.log(code_path);
  console.log(lang)
  document.getElementById('run').setAttribute('value','compiling');
  document.querySelector("#run").style.backgroundColor="#1abc9c";
  document.querySelector("#run").style.color="white";
  document.querySelector(".fas.fa-play").style.color="white";
  var jsonData={
    'code_path':code_path,
    'lang':lang
  }
  var jsonString=JSON.stringify(jsonData);
  var xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.getElementById('output-screen').value=this.responseText;
      document.getElementById('run').setAttribute('value','run');
      document.querySelector("#run").style.backgroundColor="#2f3640";
      document.querySelector(".fas.fa-play").style.color="e74c3c";
    }
  }
  xhttp.open("POST","../include/ajaxexeccode.php",true);
  xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
  xhttp.send(jsonString);
}

