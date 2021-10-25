<?php
require_once 'Controllers/errorP.php';
class app{

function __construct(){

     $url = isset($_GET['url']) ?$_GET['url'] :null;
     $url = rtrim($url,"/");
     $url = explode("/",$url);

     if(empty($url[0])){
         $archivocontroller = "Controllers/login.php";
         require_once $archivocontroller;
         $controller = new login();
         $controller->render();
         return false;
     }

     $archivocontroller = "Controllers/".$url[0].".php";

    if(file_exists($archivocontroller)){
        require_once $archivocontroller;
        $controller = new $url[0];
        $controller->loadModel($url[0]);

         $nparam = sizeof($url);
         if($nparam>1){
             
           if($nparam>2){
               $param=[];
               for($i=2;$i<$nparam;$i++){
                   array_push($param,$url[$i]);
               }
            //    var_dump($param);
            if(method_exists($controller,$url[1])){
               $controller->{$url[1]}($param);
            }
            else{ header("location:".constant('URL')."errorP"); }
           }

           else{
            if(method_exists($controller,$url[1])){
            $controller->{$url[1]}();
             }
            else{ header("location:".constant('URL')."errorP"); }
            }
          }

         else{ $controller->render();}
     }
    else{
        $controller = new errorP();
        $controller->render();
    }
}
}
?>
