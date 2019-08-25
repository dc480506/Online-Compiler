var editor = CodeMirror.fromTextArea(document.getElementById("demotext"), {
          lineNumbers: true,
          mode:"text/x-java",
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
  });
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
var u=document.querySelector(".user-options");
document.querySelector(".fas.fa-caret-down").addEventListener("click",function(){
  if(u.style.display=="none"){
  u.style.display="block";
}else{
  u.style.display="none";
}
})