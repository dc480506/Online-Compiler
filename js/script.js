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
//var clayout="sidebyside"
document.getElementById("layout").addEventListener("click",function(){
  if(clayout=="sidebyside"){
    clayout="topdown"
    console.log(clayout)
     document.querySelector('.status-bar').style.width="100%";
     document.querySelector('.CodeMirror').style.width="100%"
     document.querySelector('.CodeMirror').style.height="55%"
     /*document.querySelector('#resize').style.height="0.8%"
     document.querySelector('#resize').style.top="60%"
     document.querySelector('#resize').style.width="90%"
     document.querySelector('#resize').style.cursor="ns-resize"
     document.querySelector('#resize').style.left="10%"*/
     document.querySelector('#output').style.top="60.5%"
     document.querySelector('#output').style.width="100%"
     document.querySelector('#output').style.height="39.5%"
     document.querySelector('#output').style.left="0%"
     document.getElementsByClassName("toggle-btn")[1].style.backgroundColor="#3498db";
     document.getElementsByClassName("circle")[1].style.transform="translateX(115%)";
     $("#output").resizable('destroy');
    /* $("#output").resizable({handles:"n",maxHeight:0.5*$("#parent").height(),minHeight:0.25*$("#parent").height()});
     $('#output').resize(function(){
    // $('.CodeMirror').height($("#parent").height()-$("#output").height()); 
});*/
  }else{
      clayout="sidebyside"
      document.querySelector('.status-bar').style.width="65%";
      document.querySelector('.CodeMirror').style.width="65%"
      document.querySelector('.CodeMirror').style.height="95%"
     /* document.querySelector('#resize').style.height="90%"
      document.querySelector('#resize').style.top="10%"
      document.querySelector('#resize').style.width="0.2%"
      document.querySelector('#resize').style.cursor="ew-resize"
      document.querySelector('#resize').style.left="70%"*/
      document.querySelector('#output').style.top="0%"
      document.querySelector('#output').style.width="34.8%"
      document.querySelector('#output').style.height="100%"
      document.querySelector('#output').style.left="65.2%"
      document.getElementsByClassName("toggle-btn")[1].style.backgroundColor="gray";
      document.getElementsByClassName("circle")[1].style.transform="translateX(0%)";
     // $("#output").resizable('destroy');
      $("#output").resizable({handles:"w",maxWidth:0.5*$("#parent").width(),minWidth:0.25*$("#parent").width()});
      $('#output').resize(function(){
         $('.CodeMirror').width($("#parent").width()-$("#output").width()-0.002*$("#parent").width()); 
         $('.status-bar').width($("#parent").width()-$("#output").width()-0.002*$("#parent").width()); 
      });
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

/*document.querySelector(".fas.fa-pen").addEventListener("click",function(){
  document.querySelector("#rename-box").style.display="flex";
  document.querySelector("#cancel").style.display="flex";
  document.querySelector("#code-name").style.display="none";
})

document.querySelector("#cancel").addEventListener("click",function(){
  document.querySelector("#rename-box").style.display="none";
  document.querySelector("#cancel").style.display="none";
  document.querySelector("#code-name").style.display="flex";
})*/

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
  console.log(jsonData);
  var jsonString=JSON.stringify(jsonData);
  console.log(jsonString);
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
var enablerun=true;
function executeCode(code_path,lang){
  if(enablerun){
    enablerun=false;
  console.log("Called 2");
  console.log(code_path);
  console.log(lang)
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
      //if(this.responseText==""){
        runCode(code_path,lang);
        
      //}
    }else{
      document.getElementById('run').setAttribute('value','compiling');
      document.querySelector("#run").style.backgroundColor="#1abc9c";
      document.querySelector("#run").style.color="white";
      document.querySelector(".fas.fa-play").style.color="white";
    }
  }
  xhttp.open("POST","../include/ajaxexeccode.php",true);
  xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
  xhttp.send(jsonString);
}
}
var pid,textarealength=0;
function runCode(code_path,lang){
  var jsonData={
    'code_path':code_path,
    'lang':lang
  }
  var b=false;
  var jsonString=JSON.stringify(jsonData);
  var xhttp=new XMLHttpRequest();
  document.querySelector('.stop').style.display="flex"
  xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      //document.getElementById('output-screen').value=this.responseText;
      document.getElementById('run').setAttribute('value','run');
      document.querySelector("#run").style.backgroundColor="#2f3640";
      document.querySelector(".fas.fa-play").style.color="e74c3c";
      document.querySelector('.stop').style.display="none"
      enablerun=true;
    }else{
      document.getElementById('run').setAttribute('value','running');
      document.querySelector("#run").style.backgroundColor="#1abc9c";
      document.querySelector("#run").style.color="white";
      document.querySelector(".fas.fa-play").style.color="white";
    }
  }
  var lastResponseLength;
  xhttp.onprogress=function(e){
   // alert(e.currentTarget.responseText);
   var response = e.currentTarget.response;
   console.log(response);
   if(!b){
     b=true;
     pid=response;
     lastResponseLength=pid.length;
   }else{
   var output = typeof lastResponseLength === typeof undefined? response: response.substring(lastResponseLength);
   console.log(output);
   lastResponseLength = response.length;
   document.getElementById('output-screen').value+=output;
   textarealength=document.getElementById('output-screen').value.length;
   }
  }
  xhttp.open("POST","../include/run.php",true);
  xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
  xhttp.send(jsonString);
}

/*var source = new EventSource("../include/sendoutput.php");
source.onmessage = function(event) {
  document.getElementById("output-screen").value += event.data;
};*/
function stopCode(){
  var jsonData={
    'pid':pid
  }
  document.getElementById('stop').setAttribute('value','stopping');
  document.querySelector(".execute").style.display="none";
  var jsonString=JSON.stringify(jsonData);
  var xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.querySelector(".stop").style.display="none";
      document.getElementById('stop').setAttribute('value','stop');
      document.getElementById('run').setAttribute('value','run');
      document.querySelector("#run").style.backgroundColor="#2f3640";
      document.querySelector(".fas.fa-play").style.color="e74c3c";
      document.querySelector('.execute').style.display="flex";

    }
  }
  xhttp.open("POST","../include/stop.php",true);
  xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
  xhttp.send(jsonString);
}

/*function sendUserInput(e,textarea){
  var code=(e.keycode? e.keycode:e.which);
  text=document.getElementById("output-screen").value
  console.log(lastResponseLength)
  if(code==13){
  var input=text.substring(lastResponseLength-pid.length);
  console.log(input)
  }*/
  function sendUserInput(e,code_path){
    var code=(e.keycode? e.keycode:e.which);
    text=document.getElementById("output-screen").value
    console.log(textarealength)
    if(code==13){
    var input=text.substring(textarealength);
    console.log(input)
    var jsonData={
      'code_path':code_path,
      'input':input
    }
    var jsonString=JSON.stringify(jsonData);
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
  
      }
    }
    xhttp.open("POST","../include/createInput.php",true);
    xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
    xhttp.send(jsonString);
  }
}

document.getElementById("output-screen").addEventListener('keydown',function(e){
  var cursor=document.getElementById('output-screen').selectionStart
  console.log("Textarealength is "+(textarealength-1))
  if(e.keyCode==8)
    cursor--;
  console.log("cursor value is "+cursor)
  if(cursor<=textarealength-1 && e.keyCode!=37 && e.keyCode!=38 && e.keyCode!=39 && e.keyCode!=40){
    e.preventDefault();
    console.log("In here")
    return false;
  }else{
    return true;
  }
})