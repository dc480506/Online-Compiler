document.querySelector('#add-button').addEventListener('click',
    function() {
        document.querySelector('.create-box').style.display = 'flex';
        document.querySelector('.bg').style.opacity = '0.4';
    });
document.querySelector('.fa-window-close').addEventListener('click',
    function() {
        document.querySelector('.create-box').style.display = 'none';
        document.querySelector('.bg').style.opacity = '1';
    });

var codename=document.getElementById("code-name");// input tag inside renamebox
var codelang=document.getElementById("code-lang");// input tag inside renamebox
var rename_btn=document.querySelectorAll('.r-btn');// rename button inside form tag
var showRename=function() {
    document.querySelector('.rename-box').style.display = 'flex';
    document.querySelector('.bg').style.opacity = '0.4';
    var a=this.getAttribute("name");// getting codename stored in button attribute name
    var b=this.getAttribute("value");// getting language stored in button attribute value
    codename.setAttribute("value",a);
    codelang.setAttribute("value",b);
}
for(var i=0;i< rename_btn.length;i++){
    rename_btn[i].addEventListener('click',showRename,false);
}

document.getElementById("close-rename").addEventListener("click",function(){
   document.querySelector('.rename-box').style.display='none';
   document.querySelector('.bg').style.opacity='1';
},false);