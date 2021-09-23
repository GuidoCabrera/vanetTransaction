<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<ul id="menu">
 <?php
//  $link = "http://"."$_SERVER[HTTP_HOST]"."$_SERVER[REQUEST_URI]";
     $url = "$_SERVER[REQUEST_URI]";
     $url = rtrim($url,"/");
     $url = explode("/",$url); 
     $url1 = explode("?",$url[3]);
     if(strcasecmp($url[3],"home")==0||strcasecmp($url1[0],"home")==0){
     $name = explode(" ",$_SESSION["usuario"]["name"]); ?>
   <li id="liName"> <p>Hola <?php echo $name[0] ?>!</p> </li>
   <?php } else{ ?>
    <li id="liName"> <a href="<?php echo constant("URL") ?>Home"><i class="icon-back2"></i></a> </li>
   <?php } ?>
   <li id="liIcon"> <a href="#" id="submenuBtn"><i class="icon-config"></i></a>
         <ul id="submenu">
         <?php if($_SESSION['usuario']['rol']==1){ ?>    
         <li><a href="<?php echo constant('URL')?>Movements">Movimientos</a></li>
         <li><a href="<?php echo constant('URL')?>Users">Usuarios</a></li> 
        <?php } ?>
         <li><a href="<?php echo constant('URL')?>Controllers/logOut.php">Cerrar sesion</a></li>
         <p id="pRol" style="display:none;"><?php echo $_SESSION['usuario']['rol']?></p>
         </ul>   
     </li>
</ul>

</body>
</html>