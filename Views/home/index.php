<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icons Fontastic -->
    <link href = "https://file.myfontastic.com/LdFq23nZJGopjPWyLwkvZ4/icons.css" rel="stylesheet">
    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo constant('URL')?>/public/css/EstiloMenu.css">
    <link rel="stylesheet" href="<?php echo constant('URL')?>/public/css/EstiloHome.css">
    <link rel="stylesheet" href="<?php echo constant('URL')?>/public/css/EstiloDatePicker.css">
    <title>Pagina principal</title>
</head>
<body id="bodyHome">

<?php require 'Views/responsivehomexrol.php' ?>
<?php require 'Views/menu.php' ?>

<div id="containerHome">
  
  <div id="containerHeader">

  <div id="containerSearch">

  <form action="<?php echo constant('URL') ?>home/Search?=dateToday" method="GET" id="formSearch">

    <div class="inputBox">
    <p>Fecha</p>
  <?php  if(isset($this->dateSelected)){
    $time = $this->dateSelected;
  }
   else{
     $time = date('Y-m-d');
   }
  ?>
    <input type="text" id="dateToday" value="<?php $today = date('Y-m-d'); echo $today; ?>">
    <input type="text" name="date" id="date" readOnly value="<?php echo $time ?>">
    </div>

 <?php  if($_SESSION['usuario']['rol']==1){  ?>
    <div class="inputBox">
    <p>Usuario</p>
    <?php if(isset($this->userSelected)) {
      $userSelected = $this->userSelected;
    }
    else{
      $userSelected = "Todos";
    } 
    ?>
    <select name="users" id="selectUser">
    <?php if($userSelected=="Todos"){ ?>
    <option value="All">Todos</option>
    <?php } else{ ?>
    <option value="<?php echo $this->idUserSelected; ?>"><?php echo $userSelected["Nombre"]; ?></option>
    <option value="All">Todos</option>
    <?php } foreach($this->users as $user) { 
      if($user->getId2()!=$this->idUserSelected){ ?>
    <option value="<?php $user->getId(); ?>"><?php $user->getNombre(); ?></option>
    <?php  } } ?>
  </select>
    </div>
    <?php } ?>

    </form>

    </div>

    <div id="containerChange">
   
    <div id="icons">
   <a href="#" id="btnModifyTransac"><i class="icon-pencil"></i></a>
   <a href="#" type="button" id="aTrash"><i class="icon-trash"></i></a>
   </div>

    </div>

  </div>
  <!-- Cierre container Header -->
  <?php 
  if (isset($_GET['resultado'])){
    if($_GET['resultado']=="Success"){ 
   ?> <div id="containerMessage">
   <p id="msj">Su solicitud se ha completado exitosamente</p>
   </div>
  <?php }
    } ?>

  <div id="containerBody">
  
  <div id="tableBox">
   <table>
        <tr>
          <th></th>
          <th>Movimiento</th>
          <th>Detalle</th>
          <th>Ingreso</th>
          <th>Egreso</th>
          <th>Medio de pago</th>
          <?php if($_SESSION['usuario']['rol']==1){   ?>
          <th>Usuario</th>
          <?php } ?>
        </tr>


        <?php 
        foreach($this->transaction as $allTransactions){ 
          ?>
              <td class="tdDate"><?php echo $allTransactions["date"]; ?></td>
      <?php } ?>
       
        
        <?php 
        if(!isset($this->dateSelected)){
          $date = date('Y-m-d');
        foreach($this->transaction as $transactions){ 
          if($transactions["date"]==$date){
          ?>
        <tr>
          <td><input type="checkbox" autocomplete="off" name="check-<?php echo $transactions["id"]; ?>" data-id="<?php echo $transactions["id"]; ?>"></td>
          <td id="movement<?php echo $transactions["id"]; ?>"><?php echo $transactions["movement"]; ?></td>
          <td id="detail<?php echo $transactions["id"]; ?>"><?php echo $transactions["detail"]; ?></td>
          <td id="income<?php echo $transactions["id"]; ?>" class="income"><?php echo $transactions["income"]; ?></td>
          <td id="egress<?php echo $transactions["id"]; ?>" class="egress"><?php echo $transactions["egress"]; ?></td>
          <td id="methodP<?php echo $transactions["id"]; ?>"><?php echo $transactions["methodP"]; ?></td>
          <?php if($_SESSION['usuario']['rol']==1){   ?>
          <td id="user<?php echo $transactions["id"]; ?>" class="tdUser"><?php echo $transactions["nameUser"];?></td>
          <?php } ?>
        </tr>
      <?php } } }
      else {
        foreach($this->transacSearch as $transactions){
      ?>
      <tr>
          <td><input type="checkbox" autocomplete="off" name="check-<?php echo $transactions["id"]; ?>" data-id="<?php echo $transactions["id"]; ?>"></td>
          <td id="movement<?php echo $transactions["id"]; ?>"><?php echo $transactions["movement"]; ?></td>
          <td id="detail<?php echo $transactions["id"]; ?>"><?php echo $transactions["detail"]; ?></td>
          <td id="income<?php echo $transactions["id"]; ?>" class="income"><?php echo $transactions["income"]; ?></td>
          <td id="egress<?php echo $transactions["id"]; ?>" class="egress"><?php echo $transactions["egress"]; ?></td>
          <td id="methodP<?php echo $transactions["id"]; ?>"><?php echo $transactions["methodP"]; ?></td>
          <?php if($_SESSION['usuario']['rol']==1){   ?>
          <td id="user<?php echo $transactions["id"]; ?>" class="tdUser"><?php echo $transactions["nameUser"]; ?></td>
          <?php } ?>
        </tr>
        <?php } }  ?>

</table>
</div>

<div id="tableBoxResults">
<table>
    <tr>
      <th>Total ingreso diario</th>
      <th>Total egreso diario</th>
      <th>Total</th>
    </tr>

      <tr>
          <td id="totalIncome"></td>
          <td id="totalEgress"></td>
          <td id="total"></td>
      </tr>
</table>
</div>

  </div>

  <!-- Cierre containerBody -->

  <div id="containerFooter">

   <form action="<?php echo constant("URL") ?>Home/insertTransaction" method="POST" id="formHome">

   <div id="inputGroup">

     <div class="inputBox">
       <p>Movimiento</p>
       <select name="selectMovement" id="selectMovement">
       <?php foreach($this->movements as $movement){ ?>
             <option value="<?php echo $movement["id"] ?>"><?php echo $movement["name"] ?></option>
       <?php } ?>
       </select>
     </div>
     <div class="inputBox">
       <p>Ingreso</p>
       <input type="text" name="entry"  autocomplete="off" autocomplete="false" placeholder="Establezca el monto del ingreso">
     </div>
     <div class="inputBox">
       <p>Egreso</p>
       <input type="text" name="egress" autocomplete="off" placeholder="Establezca el monto del egreso">
     </div>
     <div class="inputBox">
       <p>Detalle</p>
       <input type="text" name="detail" autocomplete="off" placeholder="Establezca un detalle">
     </div>
     <div class="inputBox" id="boxSelectPay">
       <p>Medio de pago</p>
       <select name="selectPayment" id="selectPayment">
       <option value="">Efectivo</option>
       <option value="">Transferencia bancaria</option>
       <option value="">Debito</option>
       <option value="">Cheque</option>
       <option value="">Mercado pago</option>
       </select>
     </div>
     <?php if(isset($_GET["date"])&&isset($_GET["users"])&&$_SESSION["usuario"]["rol"]==1){ ?>
      <input type="text" value="<?php echo $_GET["date"] ?>" name="dateFooter" id="dateFooter">
      <input type="text" value="<?php echo $_GET["users"] ?>" name="userFooter" id="userFooter">
      <?php } ?>
      <?php if(isset($_GET["date"])&&$_SESSION["usuario"]["rol"]==2){ ?>
      <input type="text" value="<?php echo $_GET["date"] ?>" name="dateFooter" id="dateFooter">
      <?php } ?>

       <div id="btnBox">
         <button type="submit" id="btnHome"><i class="icon-check"></i></button>
       </div>

  </div>  

     </form>
     
  </div>
  <!-- Cierre containerFooter -->
 <p id="respa"></p>
 <p id="respa2"></p>
</div>

<div id="containerModifyTransac" class="containerModalHome">

<div id="modalH" class="modalModifH">
  <h2 id="titleModalH">Modificar Transaccion</h2>

  <form action="" method="POST" id="formModifyH">
      <div id="containerGroup">

      <div class="inputBox">
      <p id="pMov">Movimiento: </p>
      <select name="modifMov" id="selectModifMov">
        <!-- <option value="1">1</option>
        <option value="2">2</option> -->
      </select>
      </div>

      <div class="inputBox">
        <p id="pDetail">Detalle: </p>
        <input type="text" id="InputModifDetail" autocomplete="off">
      </div>

      <div class="inputBox">
        <p id="pEntry">Ingreso: </p>
        <input type="text" id="inputModifEntry" autocomplete="off">
      </div>

      <div class="inputBox">
        <p id="pEgress">Egreso: </p>
        <input type="text" id="inputModifEgress" autocomplete="off">
      </div>

      <div class="inputBox">
        <p id="pMethodPayment">Medio de pago: </p>
       <select name="modifySelectPayment" id="modifySelectPayment">
       </select>
      </div>

      <div id="btnBoxModify">
     <button type="button" id="btnCloseModify">Cerrar</button>
     <button type="button" id="btnModify">Modificar</button>
      </div>

      </div>
  </form>
</div>

</div>

<script src="<?php echo constant("URL")?>public/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo constant("URL")?>public/js/datepicker.js"></script>
<script src="<?php echo constant("URL")?>public/js/menu.js"></script>
<script src="<?php echo constant("URL")?>public/js/url.js"></script>
<script src="<?php echo constant("URL")?>public/js/home.js"></script>
<script src="<?php echo constant("URL")?>public/js/modalHome.js"></script>


</body>
</html>