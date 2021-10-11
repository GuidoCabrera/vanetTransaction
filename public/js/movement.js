var btnDelete = document.getElementById("btnDelet");
var form = document.getElementById("formDelete");
var optionSelected = document.getElementById("selectMovement");
var selectModify = document.getElementById("selectModify");
var inputModify = document.getElementById("inputModify");
var btnModify = document.getElementById("btnModify");
var formModify = document.getElementById("formModify");
var msj = document.getElementById("msj");
var divmsj = document.getElementById("divMsj");

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

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
      if(e.keyCode == 13) {
        e.preventDefault();
      }
    }))
  });

btnDelete.addEventListener("click",function(){
    const index = optionSelected.selectedIndex;
    const confirm = window.confirm("Esta seguro que desea eliminar el movimiento '"+optionSelected[index].textContent+"'?");
    
    if(confirm){
        form.submit();
    }
});

selectModify.addEventListener("change",function(){
    const index2 = selectModify.selectedIndex;
    inputModify.value = selectModify[index2].textContent;
});

btnModify.addEventListener("click",function(){
    const index2 = selectModify.selectedIndex;
    const confirm = window.confirm("Esta seguro que desea modificar el movimiento '"+selectModify[index2].textContent+"' a '"+inputModify.value+"'?");

    if(confirm){
       formModify.submit();
    }

});