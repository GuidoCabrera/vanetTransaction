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
        let tam = window.innerWidth;
        if(rol.textContent==1){
           if(tam<=528){
              subMenu.style.maxHeight = "200px";
            }
           else{
              subMenu.style.maxHeight = "181px";
            }
        }
        else{
            if(tam<=528){
                subMenu.style.maxHeight = "70px";
                subMenu.style.transition = "max-height 0.13s ease-out";
              }
            else{
                subMenu.style.maxHeight = "61px";
                subMenu.style.transition = "max-height 0.20s ease-out";
              }
        }
        subMenu.style.height = "auto";
        subMenu.style.zIndex = "3";
    }
});
