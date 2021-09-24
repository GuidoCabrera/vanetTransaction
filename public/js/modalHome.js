var btnModifyTransac = document.getElementById("btnModifyTransac");
var modal = document.getElementById("modalH");
var body = document.getElementById("bodyHome")
var containerModal = document.getElementById("containerModifyTransac");
var btnClose = document.getElementById("btnCloseModify");
var btnModify = document.getElementById("btnModify");
var subMenu = document.getElementById("submenu");
var checkBox2 = document.querySelectorAll("#tableBox tr td input[type=checkBox]");
var pModif = document.querySelectorAll('#containerModifyTransac form .inputBox p');
var inputsModif = document.querySelectorAll('#containerModifyTransac form .inputBox input');
var selectMethodPay = document.getElementById("modifySelectPayment");
var selectTransacMP = document.getElementById("selectPayment");
var selectMovement = document.getElementById("selectModifMov");
var selectTransacMov = document.getElementById("selectMovement");
var transactionsM = [[],[],[],[],[],[]];

   selected2 = (e) =>{

    if(e.target.checked){
      let array = ["movement","detail","income","egress","methodP"];
      for(var i=0;i<5;i++){ transactionsM[i].push(document.getElementById(array[i]+e.target.dataset.id).textContent); }
      transactionsM[5].push(e.target.dataset.id);
    }
    else{
      removeArr2(transactionsM[0],transactionsM[1],transactionsM[2],transactionsM[3],transactionsM[4],transactionsM[5],e.target.dataset.id);
    }
  }

  function removeArr2(movement,detail,income,egress,methodP,arrayId,id){
    var y = arrayId.indexOf(id);
    let array = [movement,detail,income,egress,methodP,arrayId];
    if(y!==-1){ array.forEach(element=>element.splice(y,1)); }
  }

  checkBox2.forEach((e)=>{
    e.addEventListener("change",selected2); });
  
  btnModifyTransac.addEventListener("click",function(){

    if(transactionsM[5].length==1){
    if(subMenu.classList.contains("desplegar")){

        subMenu.removeAttribute("style");
        subMenu.classList.remove("desplegar");
    }
    for(var i=0;i<5;i++){
      pModif[i].innerHTML+='<b>'+transactionsM[i]+'</b>';
    }
    
     let optionsMovements = getOptions(transactionsM[0],selectTransacMov);
     selectMovement.innerHTML += optionsMovements;

     let optionsMethodP = getOptions(transactionsM[4],selectTransacMP);
    selectMethodPay.innerHTML += optionsMethodP;

    setClass("modalModifH modalOpen","containerModalHome show","noscroll");
    }
    else if(transactionsM[5].length==0){
      alert("No se ha seleccionado ninguna transaccion para modificar");
    }
    else{
        alert("Se debe seleccionar una sola transaccion a la hora de modificar");
    }   
});

btnClose.addEventListener("click",function(){
    clearAll(pModif,selectMethodPay,selectMovement,inputsModif);
    setClass("modalModifH","containerModalHome","");
});



btnModify.addEventListener("click",function(){
    let arrayNoSpaces = [];
    for(let i=0;i<3;i++){ arrayNoSpaces[i]=inputsModif[i].value.replace(/ /g, ""); }
    if(selectMovement.options[selectMovement.selectedIndex].textContent==transactionsM[0]&&selectMethodPay.options[selectMethodPay.selectedIndex].textContent==transactionsM[4]
      &&(inputsModif[0].value==transactionsM[1]||arrayNoSpaces[0]=="")&&(inputsModif[1].value==transactionsM[2]||arrayNoSpaces[1]=="")&&(inputsModif[2].value==transactionsM[3]||arrayNoSpaces[2]=="")){
      alert("No se ha realizado ninguna modificacion");
    }
    else{
      let array = [];
      let arrayValues = [];
      arrayValues[0] = inputsModif[0].value;
      for(let y=1;y<3;y++){ arrayValues[y]=arrayNoSpaces[y]; }
      let valueMovement = selectMovement.options[selectMovement.selectedIndex].textContent;
      let valuePayment = selectMethodPay.options[selectMethodPay.selectedIndex].textContent;
      for(let x=0;x<3;x++){ if(arrayValues[x]==""){ arrayValues[x]=transactionsM[1+x]; }}
       array.push(valueMovement,arrayValues[0].toString(),arrayValues[1].toString(),arrayValues[2].toString(),valuePayment,transactionsM[5].toString());
       var param = JSON.stringify(array);
       $.ajax({
        type: 'POST',
        url: constantURL+'home/modifyTransac',
        data: { ArrayJson: param},
        success: function(respa) {
           $("#respa2").html(respa);
     },
       error: function () {
           alert("error");
       }
     });
    }
});

function getOptions(value,select){
  let options = "";
      for(let i=0;i<select.length;i++){
           if(select.options[i].textContent!=value){
             if(options==""){
               options += `<option value="">`+value+`</option>`;
               options += `<option value="">`+select.options[i].textContent+`</option>`;
             }
             else{ options += `<option value="">`+select.options[i].textContent+`</option>`; }
           }
      }
    return options; }

function clearAll(pModif,selectMethodPay,selectMovement,inputs){
  let array = ["Movimiento: ","Detalle: ","Ingreso: ","Egreso: ","Medio de pago: "];
  for(let i=0;i<pModif.length;i++){ pModif[i].innerHTML = array[i]; }
  selectMethodPay.innerHTML = "";
  selectMovement.innerHTML = "";
  inputs.forEach((e)=>{
     e.value = "";
  });
}

function setClass(classModal,classCont,classBody){
  modal.setAttribute("class",classModal);
  containerModal.setAttribute("class",classCont);
  body.setAttribute("class",classBody);
}