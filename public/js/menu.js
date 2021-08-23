var btn = document.getElementById("submenuBtn");
var subMenu = document.getElementById("submenu");
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
        subMenu.style.maxHeight = "200px";
        subMenu.style.height = "auto";
        subMenu.style.zIndex = "3";
    }
});
