<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
   <!-- CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/EstiloLogin.css">
    <title>Acceso</title>
</head>

<body class="bg-theme1">

<div id="containerPadre">

    <div id="container">

      <h2>Ingresos y Egresos</h2>

        <form action="<?php echo constant('URL')?>Login/Access" id="formLogin" method="POST">

      <div class="inputBox">
    <p>Nombre</p>
        <input type="text" autocomplete="off" name="name" id="inputName" placeholder="Ingrese su nombre">
     </div>

     <div class="inputBox">
     <p>Contraseña</p>
        <input type="password" autocomplete="off" name="password" id="inputSurname" placeholder="Ingrese su contraseña">
    </div>

    <div id="boxBtn">
     <button type="submit" id="btnLogin">Acceder</button>
    </div>
    <p id="txtBtn"><?php if(!empty($this->msj)){ echo $this->msj; } ?></p>

      </form>

    </div>

    </div>

<script src="<?php echo constant("URL")?>public/js/jquery-3.6.0.min.js"></script>
</body>
</html>