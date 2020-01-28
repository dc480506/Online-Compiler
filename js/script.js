document.querySelector(".fas.fa-cogs").addEventListener("click",function(){
  document.getElementById("settings-options").style.display="flex";
  document.querySelector("#panel-mode > span").innerHTML="Settings";
})
document.querySelector(".fas.fa-file-code").addEventListener("click",function(){
  document.getElementById("settings-options").style.display="none";
  document.querySelector("#panel-mode > span").innerHTML="Files";
})
document.getElementById("theme").addEventListener("click",function(){
  if(editor.options.theme=="xq-dark"){
    // editor.setOption("theme","xq-light");
   editor.setOption("theme","night");
     //editor.setOption("theme","material-ocean");
     //editor.setOption("theme","ayu-mirage");
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
    //console.log(clayout)
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
     document.querySelector("#file-name").style.left="0.65%";
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
      document.querySelector("#file-name").style.left="2%";
     // $("#output").resizable('destroy');
      $("#output").resizable({handles:"w",maxWidth:0.5*$("#parent").width(),minWidth:0.25*$("#parent").width()});
      $('#output').resize(function(){
         $('.CodeMirror').width($("#parent").width()-$("#output").width()-0.002*$("#parent").width()); 
         $('.status-bar').width($("#parent").width()-$("#output").width()-0.002*$("#parent").width()); 
      });
    }
})
var execmode="liveio";
f1=function(){
  document.querySelector("#exec-mode").style.backgroundColor="#ED4C67";
}
f2=function(){
  document.querySelector("#exec-mode").style.backgroundColor="#3498db";
}
document.querySelector("#exec-mode").addEventListener("click",function(){
  if(execmode=='liveio'){
    execmode="testcase";
    document.querySelector("#testcase-box").style.display="flex";
    document.querySelector("#exec-mode").title="Live I/O mode";
    document.querySelector("#exec-mode").style.backgroundColor="#3498db";
    document.querySelector("#exec-mode").removeEventListener("mouseover",f2)
    document.querySelector("#exec-mode").addEventListener("mouseover",f1)
    document.querySelector("#exec-mode").removeEventListener("mouseout",f1)
    document.querySelector("#exec-mode").addEventListener("mouseout",f2)
  }else if(execmode=='testcase'){
    execmode="liveio";
    document.querySelector("#testcase-box").style.display="none";
    document.querySelector("#exec-mode").title="Test case mode";
    document.querySelector("#exec-mode").style.backgroundColor="#ED4C67";
    document.querySelector("#exec-mode").removeEventListener("mouseover",f1)
    document.querySelector("#exec-mode").addEventListener("mouseover",f2)
    document.querySelector("#exec-mode").removeEventListener("mouseout",f2)
  document.querySelector("#exec-mode").addEventListener("mouseout",f1);
  }
})


document.querySelector(".fas.fa-backspace").addEventListener("click",function(){
  document.getElementById("output-screen").value="";
})

document.querySelector(".fas.fa-pen").addEventListener("click",function(){
  document.querySelector(".rename-box").style.display="flex";
  document.querySelector(".rename-box>input").style.border="1px solid #D71820";
  document.querySelector(".rename-box>button").disabled=true;
})

document.querySelector(".rename-box>span").addEventListener("click",function(){
  document.querySelector(".rename-box").style.display="none";
  document.querySelector(".rename-box>input").value="";
})
var enablerun=true;
document.querySelector("#execute").addEventListener("mouseover",function(){
  document.querySelector("#execute").style.backgroundColor="#1abc9c";
  document.querySelector("#execute").style.color="white";
  document.querySelector("#execute> .fas.fa-play").style.color="white";
  document.querySelector("#execute").style.border="1px solid white";
})
document.querySelector("#execute").addEventListener("mouseout",function(){
  if(enablerun){
  /*document.querySelector("#execute").style.backgroundColor="#2f3640";*/
  document.querySelector("#execute").style.backgroundColor="#93deff";
  /*document.querySelector("#execute> .fas.fa-play").style.color="#e74c3c";*/
  document.querySelector("#execute> .fas.fa-play").style.color="#000";
  document.querySelector("#execute").style.color="#000";
  document.querySelector("#execute").style.border="none";
  }
})
//AJAX section
function saveCode(){
  //console.log("Called");
  var codetext=editor.getValue();
  //console.log(codetext);
  //console.log(file);
  document.querySelector(".fas.fa-save").style.display="none";
  document.querySelector(".fas.fa-history").style.display="flex";
  document.querySelector("#file-status").innerHTML="saving...";
  var jsonData={
    'codetext':codetext
  };
  //console.log(jsonData);
  var jsonString=JSON.stringify(jsonData);
  //console.log(jsonString);
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
var running=false;
function executeCode(){
  if(enablerun){
    enablerun=false;
/*  var jsonData={
    'code_path':code_path,
    'lang':lang
  }
  var jsonString=JSON.stringify(jsonData);*/
  var xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.getElementById('output-screen').value=this.responseText;
     document.querySelector("#execute> span").innerText="running";
      //if(this.responseText==""){
        if(execmode=='liveio'){
        runCode();
        }else if(execmode=='testcase'){
          runCode2();
        }
      //}
    }else{
      document.querySelector("#execute> span").innerText="compiling";
      document.querySelector("#execute").style.backgroundColor="#1abc9c";
      document.querySelector("#execute").style.color="white";
      document.querySelector("#execute").style.border="1px solid white";
      document.querySelector("#execute> .fas.fa-play").style.color="white";
    }
  }
  xhttp.open("POST","../include/ajaxexeccode.php",true);
 /* xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
  xhttp.send(jsonString);*/
  xhttp.send();
}
}
var textarealength=0;
function runCode(){
  var xhttp=new XMLHttpRequest();
  document.querySelector("#output-screen").readOnly=false;
  document.querySelector('#stop').style.display="flex"
  xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.querySelector("#execute").style.backgroundColor="#93deff";
      document.querySelector("#execute").style.border="none";
      document.querySelector("#execute> span").innerText="run";
     document.querySelector("#execute").style.border="none";
     document.querySelector("#execute").style.color="#000";
      document.querySelector('#stop').style.display="none"
      document.querySelector("#execute> .fas.fa-play").style.color="#000";
      enablerun=true;
      running=false;
      document.querySelector("#output-screen").readOnly=true;
      textarealength=0;
     /* document.querySelector(".fas.fa-play").style.color="e74c3c";*/
     document.querySelector(".fas.fa-play").style.color="#000";
      document.querySelector('#execute').style.display="flex";
      document.querySelector('#stop> span').innerText="stop";
    }else{
      document.querySelector("#execute> span").innerText="running";
      running=true;
    }
  }
  var lastResponseLength;
  xhttp.onprogress=function(e){
   var response = e.currentTarget.response;
   var output = typeof lastResponseLength === typeof undefined? response: response.substring(lastResponseLength);
   //console.log(output);
   lastResponseLength = response.length;
   document.getElementById('output-screen').value+=output;
   textarealength=document.getElementById('output-screen').value.length;
   document.getElementById("output-screen").scrollTop = document.getElementById("output-screen").scrollHeight;
   console.log(lastResponseLength);
  }
  xhttp.open("POST","../include/run3.php",true);
  xhttp.send();
}

function runCode2(){
  var xhttp=new XMLHttpRequest();
  document.querySelector('#stop').style.display="flex"
  xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.querySelector("#execute").style.backgroundColor="#93deff";
      document.querySelector("#execute").style.border="none";
      document.querySelector("#execute> span").innerText="run";
     document.querySelector("#execute").style.border="none";
     document.querySelector("#execute").style.color="#000";
      document.querySelector('#stop').style.display="none"
      document.querySelector("#execute> .fas.fa-play").style.color="#000";
      enablerun=true;
      running=false;
      document.querySelector("#output-screen").readOnly=true;
      textarealength=0;
     /* document.querySelector(".fas.fa-play").style.color="e74c3c";*/
     document.querySelector(".fas.fa-play").style.color="#000";
      document.querySelector('#execute').style.display="flex";
      document.querySelector('#stop> span').innerText="stop";
    }else{
      document.querySelector("#execute> span").innerText="running";
      running=true;
    }
  }
  var lastResponseLength;
  xhttp.onprogress=function(e){
   var response = e.currentTarget.response;
   var output = typeof lastResponseLength === typeof undefined? response: response.substring(lastResponseLength);
   //console.log(output);
   lastResponseLength = response.length;
   document.getElementById('output-screen').value+=output;
   textarealength=document.getElementById('output-screen').value.length;
   document.getElementById("output-screen").scrollTop = document.getElementById("output-screen").scrollHeight;
   console.log(lastResponseLength);
  }
  var input=document.querySelector("#input-text").value;
  var jsonData={
    'inputs':input
  }
  var jsonString=JSON.stringify(jsonData);
  xhttp.open("POST","../include/run4.php",true);
  xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
  xhttp.send(jsonString);
}
function stopCode(){
if(!enablerun){
  document.querySelector('#stop> span').innerText="stopping";
  document.querySelector("#execute").style.display="none";
  var xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
    //   document.querySelector("#stop").style.display="none";
    //  /* document.querySelector(".fas.fa-play").style.color="e74c3c";*/
    //  document.querySelector(".fas.fa-play").style.color="#000";
    //   document.querySelector('#execute').style.display="flex";
    //   document.querySelector('#stop> span').innerText="stop";
    }
  }
  xhttp.open("POST","../include/stop.php",true);
  xhttp.send();
}
}


  function sendUserInput(e){
    if(running){
    var code=(e.keycode? e.keycode:e.which);
    text=document.getElementById("output-screen").value
    //console.log(textarealength)
    if(code==13){
    var input=text.substring(textarealength);
    if(input.charAt(0)=='\n'){
      input=input.substring(1);
    }
    //console.log(input)
    textarealength=document.getElementById("output-screen").value.length;
    var jsonData={
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
}

document.getElementById("output-screen").addEventListener('keydown',function(e){
  var cursor=document.getElementById('output-screen').selectionStart
  //console.log("Textarealength is "+(textarealength-1))
  if(e.keyCode==8)
    cursor--;
  //console.log("cursor value is "+cursor)
  if(cursor<=textarealength-1 && e.keyCode!=37 && e.keyCode!=38 && e.keyCode!=39 && e.keyCode!=40){
    e.preventDefault();
    return false;
  }else{
    return true;
  }
})

document.querySelector(".rename-box>input").addEventListener("keyup",function(){
  var xhttp=new XMLHttpRequest();
  var newname=document.querySelector(".rename-box>input").value;
  var jsonData={
    'newname':newname,
    'op':1
  }
  var jsonString=JSON.stringify(jsonData);
 xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      if(this.responseText==""){
        document.querySelector(".rename-box>input").style.border="1px solid #49C144";
        document.querySelector(".rename-box>button").disabled=false;
      }else{
        document.querySelector(".rename-box>input").style.border="1px solid #D71820";
        document.querySelector(".rename-box>button").disabled=true;
      }
    }
  }
  xhttp.open("POST","../include/ajaxrenamebox.php",true);
  xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
  xhttp.send(jsonString);
})
document.querySelector(".rename-box>button").addEventListener("click",function(){
  var xhttp=new XMLHttpRequest();
  var newname=document.querySelector(".rename-box>input").value;
  var jsonData={
    'newname':newname,
    'op':2
  }
  document.querySelector(".rename-box>button>span").innerText="Renaming...";
  document.querySelector(".rename-box>button").disabled=true;
  var jsonString=JSON.stringify(jsonData);
 xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.querySelector(".code-info>span").innerText=newname;
      document.querySelector(".rename-box>button>span").innerText="Rename";
      document.querySelector(".rename-box>button").disabled=false;
      if(this.responseText=="Java"){
        document.querySelector("#file-name").innerText=newname+".java";
      }
    }
  }
  xhttp.open("POST","../include/ajaxrenamebox.php",true);
  xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8");
  xhttp.send(jsonString);
})
window.addEventListener('beforeunload',function(e){
  stopCode();
})