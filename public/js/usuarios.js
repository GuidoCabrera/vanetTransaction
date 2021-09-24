var inputs = document.querySelectorAll("#inputGroup input");
var btnModif = document.getElementById("btnModif");
var btnDelet = document.getElementById("btnDelet");
var btnSubModif = document.getElementById("btnUsers");
var select = document.getElementById("selectUser");
var options = document.querySelectorAll("#selectUser option");
var inputName = document.getElementById("inputNewName");
var form = document.getElementById("formUsers");
var form1 = document.getElementById("formDataUsers");
var form2 = document.getElementById("formNewUser");
var btnNew = document.getElementById("btnCreate");
var inputRol = document.getElementById("rolUser");
var msj = document.getElementById("msj");
var divmsj = document.getElementById("divMsj");

//Valores Iniciales
const valueInputs = {
    name: inputs[0].value,
    surname: inputs[1].value,
    password: inputs[2].value,
    rol: inputs[3].value
}

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
    if(e.keyCode == 13) {
      e.preventDefault();
    }
  }))
});

window.onload = function(){
  if(msj==""||msj==null){
  }
  else{
     setTimeout(function(){
       msj.textContent= "";
       divmsj.style.display = "none";
     }, 4000);
  }
}

//Permitiendo escritura en los input de modificacion
btnModif.addEventListener("click", function(){
    inputs.forEach((input) => {
       input.disabled = false;
        });
});

//Modificacion de usuarios
btnSubModif.addEventListener("click",function(){

  var aux2 = verifyName2(inputs[0].value);

if(aux2){
    if(valueInputs.name==inputs[0].value&&valueInputs.surname==inputs[1].value&&valueInputs.password==inputs[2].value&&valueInputs.rol==inputs[3].value){
        alert("No se ha realizado ningun cambio");
    }
    else{
      if(inputs[0].value!==""&&inputs[1].value!==""&&inputs[2].value!==""&&inputs[3].value!==""){
        if(inputs[3].value==2||inputs[3].value==1){
         form1.submit();
      }
      else{
        alert("Solo se acepta valor 1(Admin) y 2(Estandar) en el campo de rol");
      }
    }
    else{
      alert("Hay campos sin completar");
    }
    }
  }
  else{
    alert("Este Nombre de usuario ya existe, tendras que elegir un distinto");
  }
});

// Cambiando usuario
 select.addEventListener("change",function(){
	form.submit();
 });

 // Eliminacion de usuarios
 btnDelet.addEventListener("click", function(){

  const confirm = window.confirm("Estas seguro que deseas eliminar a "+valueInputs.name+" "+valueInputs.surname+"?");

  if(confirm){
  var dataex = "id="+inputs[4].value;

  $.ajax({
    type:'post',
    url: constantURL+'Users/deleteUser',
    data: dataex,
    success: function(resp){
      $("#respa").html(resp);
    }
    });

    return false;
  }
 });

 //Crear nuevo usuario
 btnNew.addEventListener("click",function(){

  var aux = verifyName(inputName.value);

  if(aux){
   if(inputs[0].value!==""&&inputs[1].value!==""&&inputs[2].value!==""&&inputs[3].value!==""){
         if(inputRol.value==1||inputRol.value==2){
          form2.submit();
         }
         else{
           alert("Solo se aceptan valor 1(Admin) o 2(Estandar) en el campo de Rol");
         }
       }
       else{
         alert("Hay campos sin completar");
       }
     }
     else{
       alert("El nombre elegido para el nuevo usuario ya existe, eliga uno diferente");
     }
 });

 // Funcion que Verifica si el nombre ya existe
 function verifyName(name){
  var auxBool = true;
  var a = String(name);
    
   options.forEach((e) => {
    
     if(e.text.toUpperCase()==a.toUpperCase()){
        auxBool = false;
     }
 });
    return auxBool;
 }

 // Funcion que Verifica si el nombre es diferente al ya establecido y si ya existe
 function verifyName2(name){
  var auxBool = true;
  var a = String(name);
    
   options.forEach((e) => {
     if(a.toUpperCase()!=valueInputs.name.toUpperCase()){
     if(e.text.toUpperCase()==a.toUpperCase()){
        auxBool = false;
     }
    }
 });
    return auxBool;
 }
