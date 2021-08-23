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
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/EstiloUsers.css">
    <title>Usuarios</title>
</head>
<body class="bg-theme" id="bodyUser">
<?php require 'Views/menu.php' ?>
   
<div id="containerUser">
  
  <div id="containerHeader">

  <div id="containerSearch">

    <div class="inputBox">
    <p>Usuario</p>
    <form action="<?php echo constant("URL") ?>Users/SelectedUser" id="formUsers" method="POST">
    <select name="users" id="selectUser">
    <?php if(!isset($this->usuarioSeleccionado)) { ?>
    <option value="<?php $this->usuarioActual->getId();?>"> <?php $this->usuarioActual->getNombre(); ?></option>
    <?php 
    foreach($this->usuarios as $usuario){ 
       if($usuario->getId2()!=$_SESSION["usuario"]["id"]){  ?>
      <option value="<?php $usuario->getId();?>"> <?php $usuario->getNombre(); ?></option>
   <?php } } } 
     
   else{  ?>
    <option value="<?php $this->usuarioSeleccionado->getId();?>"> <?php $this->usuarioSeleccionado->getNombre(); ?></option>
   <?php foreach($this->usuarios as $usuario){ 
     if($this->usuarioSeleccionado->getId2()!=$usuario->getId2()){  ?>
         <option value="<?php $usuario->getId();?>"> <?php $usuario->getNombre(); ?></option>
   <?php }}}
   ?>

  </select>
  </form>
    </div>

    </div>

    <div id="containerChange">
   
    <div id="icons">
   <a href="#" id="btnNew"><i class="icon-new"></i></a>
   <a href="#" id="btnModif"><i class="icon-pencil"></i></a>
   <a href="#" id="btnDelet"><i class="icon-trash"></i></a>
   </div>

    </div>

  </div>

  <!-- Cierre container Header -->

  <div id="containerBody">

   <form action="<?php echo constant("URL")?>Users/modifyUser" method="POST" id="formDataUsers">

   <?php 
    if (isset($_GET['resultado'])){
    if($_GET['resultado']=="Success"){ 
   ?> <div id="divMsj">
   <p id="msj">Peticion completada exitosamente!</p>
   </div>
  <?php }} ?>

   <div id="inputGroup">

   <?php if(!isset($this->usuarioSeleccionado)){ ?>

     <div class="inputBox">

       <p>Nombre</p>
       <input type="text" name="name" autocomplete="off" disabled="true" value="<?php $this->usuarioActual->getNombre(); ?>">
     </div>
     <div class="inputBox">
       <p>Apellido</p>
       <input type="text" name="surname" autocomplete="off" disabled="true" value="<?php $this->usuarioActual->getApellido(); ?>">
     </div>
     <div class="inputBox">
       <p>Contraseña</p>
       <input type="password" name="password" autocomplete="off" disabled="true" value="<?php $this->usuarioActual->getContraseña(); ?>">
     </div>
     <div class="inputBox">
       <p>Rol</p>
       <input type="text" name="rol" autocomplete="off" disabled="true" value="<?php $this->usuarioActual->getRol(); ?>">
     </div>
     <input type="number" name="id" autocomplete="off" style="display:none;" value="<?php $this->usuarioActual->getId(); ?>">
     

    <?php } else{  ?>

      <div class="inputBox">
       <p>Nombre</p>
       <input type="text" name="name" autocomplete="off" disabled="true" value="<?php $this->usuarioSeleccionado->getNombre(); ?>">
     </div>
     <div class="inputBox">
       <p>Apellido</p>
       <input type="text" name="surname" autocomplete="off" disabled="true" value="<?php $this->usuarioSeleccionado->getApellido(); ?>">
     </div>
     <div class="inputBox">
       <p>Contraseña</p>
       <input type="password" name="password" autocomplete="off" disabled="true" value="<?php $this->usuarioSeleccionado->getContraseña(); ?>">
     </div>
     <div class="inputBox">
       <p>Rol</p>
       <input type="text" name="rol" autocomplete="off" disabled="true" value="<?php $this->usuarioSeleccionado->getRol(); ?>">
     </div>
     <input type="number" name="id" autocomplete="off" style="display:none;" value="<?php $this->usuarioSeleccionado->getId(); ?>">

   <?php } ?>

       <div id="btnBox">
         <button type="button" id="btnUsers">Modificar</button>
       </div>

  </div>  

     </form>
     
  </div>
  <!-- Cierre containerBody -->

</div>

<div id="containerNewU" class="containerModal">

 <div class="modal" id="modalNewU">

   <h2>Crea un nuevo usuario</h2>
    
  <form action="<?php echo constant('URL') ?>Users/newUser" method="POST" id="formNewUser">
 
  <div id="containerGroup">
   
   <div class="inputBox">
     <p>Nombre</p>
     <input type="text" name="nameUser" id="inputNewName" autocomplete="off">
   </div>

   <div class="inputBox">
     <p>Apellido</p>
     <input type="text" name="surnameUser" autocomplete="off">
   </div>

   <div class="inputBox">
     <p>Contraseña</p>
     <input type="password" name="passwordUser" autocomplete="off">
   </div>

   <div class="inputBox">
     <p>Rol</p>
     <input type="text" name="rolUser" id="rolUser" autocomplete="off">
   </div>

   <div id="btnBox2">
     <button type="button" id="btnClose">Cerrar</button>
     <button type="button" id="btnCreate">Crear</button>
   </div>
 
  </div>

  </form>

  </div>

</div>

<p id="respa" style="display:none;"></p>

<script src="<?php echo constant("URL")?>public/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo constant("URL")?>public/js/menu.js"></script>
<script src="<?php echo constant("URL")?>public/js/usuarios.js"></script>
<script src="<?php echo constant("URL")?>public/js/modalUsers.js"></script>
</body>
</html>