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
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/EstiloMenu.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/EstiloMovements.css">
    <title>Movimientos</title>
</head>
<body class="bg-theme">
 <?php require 'Views/menu.php' ?>

<div id="containerMovement">

<?php 
  if (isset($_GET['resultado'])){
    if($_GET['resultado']=="Success"){ 
   ?> <div id="divMsj">
   <p id="msj">Peticion completada exitosamente!</p>
   </div>
  <?php }} ?>

 <div id="containerDelete">
   <form action="<?php echo constant("URL") ?>Movements/deleteMovement" method="POST" id="formDelete">

    <div class="inputBox">
    <h2>Borrado de Movimientos</h2>
    <select name="movement" id="selectMovement">
     <?php foreach($this->movement as $movements) { ?>
       <option value="<?php echo $movements["id"]  ?>"><?php echo $movements["name"]; ?></option>
    <?php } ?>
    </select>
    <button type="button" id="btnDelet"><i class="icon-trash"></i></button>
    </div>

   </form>
 </div>
 
 <div id="containerNew">
 
  <form action="<?php echo constant("URL") ?>movements/newMovement" method="POST" id="formNew">
  
  <div class="inputBox">
  <h2>Nuevo Movimiento</h2>
  <input type="text" name="movement" placeholder="ingrese movimiento" autocomplete="off"> <button type="submit">Nuevo</button>
  </div>
 
  </form>

 </div>

    <div id="containerModify">
      <form action="<?php echo constant("URL") ?>Movements/ModifyMovement" method="POST" id="formModify">

      <div id="inputGroup">
        
        <div class="inputBox">
      <h2>Modificar Movimiento</h2>
      <select name="movement2" id="selectModify">
     <?php foreach($this->movement as $movements) { ?>
       <option value="<?php echo $movements["id"]  ?>"><?php echo $movements["name"]; ?></option>
    <?php } ?>
    </select>
        </div>

        <div class="inputBox">
        <input type="text" name="inputMovement" id="inputModify" autocomplete="off" spellcheck="false" value="<?php echo $this->movement[0]["name"] ?>">
        <button type="button" id="btnModify">Modificar</button>
        </div>

      </div>
      </form>
    </div>

</div>
    
<script src="<?php echo constant("URL")?>public/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo constant("URL")?>public/js/menu.js"></script>
<script src="<?php echo constant("URL")?>public/js/movement.js"></script>
</body>
</html>