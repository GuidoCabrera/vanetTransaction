var btn = document.getElementById("btnNew");
var modal = document.getElementById("modalNewU");
var containerModal = document.getElementById("containerNewU");
var btnClose = document.getElementById("btnClose");
var subMenu = document.getElementById("submenu");
var body = document.getElementById("bodyUser");

btn.addEventListener("click",function(){
    if(subMenu.classList.contains("desplegar")){
        subMenu.removeAttribute("style");
        subMenu.classList.remove("desplegar");
    }
    setClass("modal modalOpen","containerModal show","bg-theme noscroll");
});

btnClose.addEventListener("click",function(){ 
    setClass("modal","containerModal","bg-theme"); });

function setClass(classModal,classCont,classBody){
    modal.setAttribute("class",classModal);
    containerModal.setAttribute("class",classCont);
    body.setAttribute("class",classBody);
}