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
       var movement2 = document.getElementById("movement"+e.target.dataset.id);
       var detail2 = document.getElementById("detail"+e.target.dataset.id);
       var income2 = document.getElementById("income"+e.target.dataset.id);
       var egress2 = document.getElementById("egress"+e.target.dataset.id);
       var methodP2 = document.getElementById("methodP"+e.target.dataset.id);
       transactionsM[0].push(movement2.textContent);
       transactionsM[1].push(detail2.textContent);
       transactionsM[2].push(income2.textContent);
       transactionsM[3].push(egress2.textContent);
       transactionsM[4].push(methodP2.textContent);
       transactionsM[5].push(e.target.dataset.id);
    }
    else{
      removeArr2(transactionsM[0],transactionsM[1],transactionsM[2],transactionsM[3],transactionsM[4],transactionsM[5],e.target.dataset.id);
    }
  }

  function removeArr2(movement,detail,income,egress,methodP,arrayId,id){
    var y = arrayId.indexOf(id);
    if(y!==-1){
        movement.splice(y,1);
        detail.splice(y,1);
        income.splice(y,1);
        egress.splice(y,1);
        methodP.splice(y,1);
        arrayId.splice(y,1);
    }
  }

  checkBox2.forEach((e)=>{
    e.addEventListener("change",selected2);
});
  

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

    body.setAttribute("class","noscroll");
    containerModal.setAttribute("class","containerModalHome show");
    modal.setAttribute("class","modalModifH modalOpen");
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
    modal.setAttribute("class","modalModifH");
    containerModal.setAttribute("class","containerModalHome");
    body.removeAttribute("class");
});



btnModify.addEventListener("click",function(){
    let detailNoSpaces = inputsModif[0].value.replace(/ /g, "");
    let entryNoSpaces = inputsModif[1].value.replace(/ /g, ""); 
    let egressNoSpaces = inputsModif[2].value.replace(/ /g, ""); 
    if(selectMovement.options[selectMovement.selectedIndex].textContent==transactionsM[0]&&selectMethodPay.options[selectMethodPay.selectedIndex].textContent==transactionsM[4]
      &&(inputsModif[0].value==transactionsM[1]||detailNoSpaces=="")&&(inputsModif[1].value==transactionsM[2]||entryNoSpaces=="")&&(inputsModif[2].value==transactionsM[3]||egressNoSpaces=="")){
      alert("No se ha realizado ninguna modificacion");
    }
    else{
      let array = [];
      let detailModif = inputsModif[0].value;
      let entryModif = entryNoSpaces;
      let egressModif = egressNoSpaces;
      let valueMovement = selectMovement.options[selectMovement.selectedIndex].textContent;
      let valuePayment = selectMethodPay.options[selectMethodPay.selectedIndex].textContent;
      if(detailNoSpaces==""){
        detailModif = transactionsM[1];
      }
      if(entryNoSpaces==""){
         entryModif = transactionsM[2];
      }
      if(egressNoSpaces==""){
         egressModif = transactionsM[3];
      }
       array.push(valueMovement,detailModif.toString(),entryModif.toString(),egressModif.toString(),valuePayment,transactionsM[5].toString());
        // console.log(array);
       var param = JSON.stringify(array);
        // console.log(param);
       $.ajax({
        type: 'POST',
        url: 'http://192.168.2.102/PHP/vanetTransaction/home/modifyTransac',
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
             else{
               options += `<option value="">`+select.options[i].textContent+`</option>`;
           }
           }
      }
      return options;
}

function clearAll(pModif,selectMethodPay,selectMovement,inputs){
  let array = ["Movimiento: ","Detalle: ","Ingreso: ","Egreso: ","Medio de pago: "];
   for(let i=0;i<pModif.length;i++){
       pModif[i].innerHTML = array[i];
}
 selectMethodPay.innerHTML = "";
 selectMovement.innerHTML = "";
  inputs.forEach((e)=>{
     e.value = "";
  });
}
