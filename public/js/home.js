var optionsSelectPay = document.querySelectorAll("#inputGroup #selectPayment option");
var income = document.getElementsByClassName("income");
var egress = document.getElementsByClassName("egress");
var tdDate = document.getElementsByClassName("tdDate");
var tdIncome = document.getElementById("totalIncome");
var tdEgress = document.getElementById("totalEgress");
var tdTotal = document.getElementById("total");
var inputDate = document.getElementById("date");
var today = document.getElementById("dateToday");
var selectName = document.getElementById("selectUser");
var formSearch = document.getElementById("formSearch");
var checkBox = document.querySelectorAll("#tableBox tr td input[type=checkBox]");
var aTrash = document.getElementById("aTrash");
var msj = document.getElementById("msj");
var divmsj = document.getElementById("containerMessage");
// var buttonToday = document.getElementsByClassName("xdsoft_today_button");
var totalI = 0;
var totalE = 0;
var total = 0;
var arrayDates = [];
var transactions = [[],[],[]];

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
    if(e.keyCode == 13) {
      e.preventDefault();
    }
  }))
});

window.onload = function(){
    optionsSelectPay.forEach(element => {
        element.value = element.textContent;
    });

      if(msj==""||msj==null){
      }
      else{
        setTimeout(function(){
          msj.textContent= "";
          divmsj.style.display = "none";
        }, 4000);
      }
}

// Calculando totales de ingreso y egreso, y calculando el resultado final

for(var i=0;i<income.length;i++){
    totalI += parseInt(income[i].textContent);
    totalE += parseInt(egress[i].textContent);
}

 tdIncome.textContent = totalI;
 tdEgress.textContent = totalE;
 tdTotal.textContent = totalI-totalE;

 //Insertando y estableciendo restriccion tipo Date

 for(var e=0;e<tdDate.length;e++){
    var tdText = tdDate[e].textContent.replaceAll('-','/');
     if(arrayDates.length!=0){
        if(!arrayDates.includes(tdText)){
            arrayDates.push(tdText);
        }
    }
    else{
      arrayDates.push(tdText);
      var today2 = today.value.replaceAll('-','/');
      arrayDates.push(today2);
    }
 }

$(document).ready(() => {
  const date1 = new Date(); 
$('#date').datetimepicker({
  format: 'Y-m-d',
  timepicker:false,
  yearStart: 2021,
  yearEnd: 2030,
  inline:false,
  allowDates: arrayDates+date1,
  onSelectDate: function(){
     formSearch.submit();
  }
});
  });

  //Submit Busqueda usuario
 if(selectName!=null){
 selectName.addEventListener("change", function(){
  formSearch.submit();
  });
}

  //Eliminacion de Transacciones

  selected = (e) =>{

    if(e.target.checked){
       var movement = document.getElementById("movement"+e.target.dataset.id);
       var detail = document.getElementById("detail"+e.target.dataset.id);
       transactions[0].push(movement.textContent);
       transactions[1].push(detail.textContent);
       transactions[2].push(e.target.dataset.id);
    }
    else{
      removeArr(transactions[0],transactions[1],transactions[2],e.target.dataset.id);
    }
  }

  function removeArr(movement,detail,arrayId,id){
    var i = arrayId.indexOf(id);
    if(i!==-1){
        movement.splice(i,1);
        detail.splice(i,1);
        arrayId.splice(i,1);
    }
  }

  checkBox.forEach((e)=>{
      e.addEventListener("change",selected);
  });

  aTrash.addEventListener("click",function(){
    txtTransac = "";
    for(var i=0;i<transactions[0].length;i++){
      if(i!==transactions[0].length-1){
          txtTransac += "Movimiento: '"+transactions[0][i]+"', Detalle: '"+transactions[1][i]+"',"; 
      }
      else{ txtTransac += "Movimiento: '"+transactions[0][i]+"', Detalle: '"+transactions[1][i]+"'"; }
    }

    if(txtTransac!==""){
      const confirm = window.confirm("Desea eliminar a la transaccion con "+txtTransac);
      if(confirm){

        var valParam = JSON.stringify(transactions[2]);
          //  console.log(valParam);
             $.ajax({
                type: 'POST',
                url: constantURL+'home/deleteTransac',
                data: { tuArrJson: valParam},
                success: function(resp){
                   $("#respa").html(resp);
             },
               error: function () {
                   alert("error");
               }
           });
      }
    }
  });

  
