const height=document.getElementById('loginslider').clientHeight;
document.getElementById("signup").addEventListener('click',
function(){
document.getElementById('loginslider').style.transform="translateY("+(-height)+"px)";
document.getElementById('signupslider').style.transform="translateY("+(-height)+"px)";
document.getElementById('signupslider').style.visibility="visible";
})

document.getElementById("signin").addEventListener('click',
function(){
document.getElementById('loginslider').style.transform="translateY(0px)";
document.getElementById('signupslider').style.transform="translateY(0px)";
document.getElementById('signupslider').style.visibility="hidden";
})