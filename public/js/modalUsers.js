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
    body.setAttribute("class","bg-theme noscroll");
    containerModal.setAttribute("class","containerModal show");
    modal.setAttribute("class","modal modalOpen");
});

btnClose.addEventListener("click",function(){
    modal.setAttribute("class","modal");
    containerModal.setAttribute("class","containerModal");
    body.setAttribute("class","bg-theme");
});