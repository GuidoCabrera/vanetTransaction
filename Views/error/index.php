<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icons Fontastic -->
    <link href="https://file.myfontastic.com/AHaPVaXbSxDQAqiRnR8mH3/icons.css" rel="stylesheet">
    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo constant('URL')?>/public/css/EstiloMenu.css">
    <link rel="stylesheet" href="<?php echo constant('URL')?>/public/css/EstiloError.css">
    <title>Error</title>
</head>

<body>

<div id="containerError">

       <div class="error-icon">
        <i class="icon-sad"></i>
       </div>

		<div class="error-message">
			<p id="title">¡HA OCURRIDO UN ERROR!</p>
			<p id="message">Lamentablemente el recurso no ha llegado a su destino exitosamente</p>
			<p id="small">Para volver a la pagina principal haga click <a href="<?php echo constant("URL")?>Home">AQUÍ</a>
	    </div>
        
</div>

<script src="<?php echo constant("URL")?>public/js/jquery-3.6.0.min.js"></script>
</body>
</html>