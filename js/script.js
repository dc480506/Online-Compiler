var editor = CodeMirror.fromTextArea(document.getElementById("demotext"), {
          lineNumbers: true,
          mode:"text/x-java",
          theme:"darcula",
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
  if(editor.options.theme=="darcula"){
     editor.setOption("theme","3024-day");
    }else{
      editor.setOption("theme","darcula");
    }
})