var btn = document.getElementById("submenuBtn");
var subMenu = document.getElementById("submenu");
var rol = document.getElementById("pRol");
//Menu Desplegable
btn.addEventListener("click",function(){
    const subMenu = this.nextElementSibling;
    const height = subMenu.scrollHeight;
    if(subMenu.classList.contains("desplegar")){
        subMenu.removeAttribute("style");
        subMenu.classList.remove("desplegar");
    }
    else{
        subMenu.classList.add("desplegar");
        if(rol.textContent==1){
        subMenu.style.maxHeight = "181px";
        }
        else{
        subMenu.style.maxHeight = "61px";
        subMenu.style.transition = "max-height 0.20s ease-out";
        }
        subMenu.style.height = "auto";
        subMenu.style.zIndex = "3";
    }
});
